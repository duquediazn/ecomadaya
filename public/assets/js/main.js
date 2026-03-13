(function () {
    /**
     * @typedef {Object} GalleryItem
     * @property {string} smallUrl URL de miniatura.
     * @property {string} largeUrl URL de imagen ampliada.
     * @property {string} description Texto descriptivo de la imagen.
     */

    /**
     * @typedef {Object} LoadMoreLabels
     * @property {string} defaultText
     * @property {string} noMoreItemsText
     * @property {string} loadingText
     * @property {string} loadingStatusText
     * @property {string} loadErrorText
     */

    /**
     * @typedef {Object} LoadMoreContext
     * @property {HTMLElement} control
     * @property {HTMLElement} gallery
     * @property {HTMLElement|null} status
     * @property {number} batchSize
     * @property {number} total
     * @property {string} endpoint
     * @property {number} loadedCount
     * @property {number} nextOffset
     * @property {boolean} isLoading
     * @property {boolean} hasLoadError
     * @property {LoadMoreLabels} labels
     */

    /** CARGA PROGRESIVA DE GALERIA **/

    /**
     * Convierte un valor a entero y usa un fallback cuando no es valido.
     * @param {string} value
     * @param {number} defaultValue
     * @returns {number}
     */
    const parseIntOrDefault = (value, defaultValue) => {
        const parsed = Number.parseInt(value, 10);
        return Number.isInteger(parsed) ? parsed : defaultValue;
    };

    /**
     * Crea el nodo <figure> para una imagen nueva de la galeria.
     * @param {GalleryItem} item
     * @returns {HTMLElement}
     */
    const buildGalleryFigure = (item) => {
        const figure = document.createElement('figure');
        const link = document.createElement('a');
        const image = document.createElement('img');
        const caption = document.createElement('figcaption');
        const description = item.description || 'Trabajo de tapiceria';

        link.href = item.largeUrl;
        image.src = item.smallUrl;
        image.alt = description;
        image.loading = 'lazy';
        image.decoding = 'async';
        caption.textContent = description;

        link.appendChild(image);
        figure.appendChild(link);
        figure.appendChild(caption);

        return figure;
    };

    /**
     * Recoge configuracion y estado inicial para la carga progresiva.
     * @returns {LoadMoreContext|null}
     */
    const buildLoadMoreContext = () => {
        const control = document.querySelector('[data-gallery-load-more]');
        const gallery = document.getElementById('galeria-hogar-grid');

        if (!(control instanceof HTMLElement) || !(gallery instanceof HTMLElement)) {
            return null;
        }

        const batchSize = parseIntOrDefault(control.dataset.batchSize || '10', 10);
        const total = parseIntOrDefault(control.dataset.total || '0', 0);
        const endpoint = control.dataset.endpoint || '';

        if (batchSize <= 0 || endpoint === '') {
            return null;
        }

        return {
            control,
            gallery,
            status: document.getElementById('galeria-hogar-status'),
            batchSize,
            total,
            endpoint,
            loadedCount: gallery.querySelectorAll('figure').length,
            nextOffset: parseIntOrDefault(control.dataset.offset || String(gallery.querySelectorAll('figure').length), gallery.querySelectorAll('figure').length),
            isLoading: false,
            hasLoadError: false,
            labels: {
                defaultText: control.textContent?.trim() || 'Cargar más',
                noMoreItemsText: 'No hay más imágenes',
                loadingText: 'Cargando...',
                loadingStatusText: 'Cargando más imágenes...',
                loadErrorText: 'No se pudieron cargar más imágenes. Inténtalo de nuevo.',
            },
        };
    };

    /**
     * Actualiza el enlace fallback para modo sin JS o error de red.
     * @param {LoadMoreContext} ctx
     * @returns {void}
     */
    const updateFallbackHref = (ctx) => {
        if (!(ctx.control instanceof HTMLAnchorElement) || ctx.total <= 0) {
            return;
        }

        const nextVisibleCount = Math.min(ctx.loadedCount + ctx.batchSize, ctx.total);
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('hogar_limit', String(nextVisibleCount));
        currentUrl.hash = 'galeria-hogar';
        ctx.control.href = `${currentUrl.pathname}${currentUrl.search}${currentUrl.hash}`;
    };

    /**
     * Sincroniza el mensaje de estado anunciado por aria-live.
     * @param {LoadMoreContext} ctx
     * @returns {void}
     */
    const updateLoadMoreStatus = (ctx) => {
        if (!(ctx.status instanceof HTMLElement)) {
            return;
        }

        if (ctx.hasLoadError) {
            ctx.status.textContent = ctx.labels.loadErrorText;
            return;
        }

        if (ctx.isLoading) {
            ctx.status.textContent = ctx.labels.loadingStatusText;
            return;
        }

        if (ctx.total > 0) {
            ctx.status.textContent = `Mostrando ${ctx.loadedCount} de ${ctx.total} imágenes.`;
            return;
        }

        ctx.status.textContent = `Mostrando ${ctx.loadedCount} imágenes.`;
    };

    /**
     * Actualiza disponibilidad y etiqueta del control Cargar mas.
     * @param {LoadMoreContext} ctx
     * @returns {void}
     */
    const updateLoadMoreControl = (ctx) => {
        const hasMoreItems = ctx.total > 0 ? ctx.loadedCount < ctx.total : true;
        const isDisabled = !hasMoreItems || ctx.isLoading;

        ctx.control.hidden = false;
        ctx.control.setAttribute('aria-disabled', isDisabled ? 'true' : 'false');

        if (ctx.isLoading) {
            ctx.control.textContent = ctx.labels.loadingText;
        } else if (!hasMoreItems) {
            ctx.control.textContent = ctx.labels.noMoreItemsText;
        } else {
            ctx.control.textContent = ctx.labels.defaultText;
        }

        updateFallbackHref(ctx);
    };

    /**
     * Inserta en DOM el lote recibido y mueve foco al primer elemento nuevo.
     * @param {LoadMoreContext} ctx
     * @param {GalleryItem[]} items
     * @returns {void}
     */
    const appendBatchItems = (ctx, items) => {
        const startIndex = ctx.loadedCount;

        items.forEach((item) => {
            ctx.gallery.appendChild(buildGalleryFigure(item));
        });

        ctx.loadedCount += items.length;

        // Mantenemos el foco en el primer elemento nuevo para teclado/lector de pantalla.
        const firstNewLink = ctx.gallery.querySelectorAll('figure a')[startIndex];
        if (firstNewLink instanceof HTMLElement) {
            firstNewLink.focus();
        }
    };

    /**
     * Pide al endpoint el siguiente bloque de imagenes.
     * @param {LoadMoreContext} ctx
     * @returns {Promise<{items: GalleryItem[], nextOffset: number}>}
     */
    const requestNextBatch = async (ctx) => {
        const query = new URLSearchParams({
            offset: String(ctx.nextOffset),
            limit: String(ctx.batchSize),
        });
        const response = await fetch(`${ctx.endpoint}?${query.toString()}`);

        if (!response.ok) {
            throw new Error('No se pudo cargar el siguiente bloque de imagenes.');
        }

        const data = await response.json();
        const items = Array.isArray(data.items) ? data.items : [];
        const resolvedNextOffset = parseIntOrDefault(String(data.nextOffset ?? ctx.loadedCount), ctx.loadedCount);

        return { items, nextOffset: resolvedNextOffset };
    };

    /**
     * Ejecuta el flujo completo de carga incremental.
     * @param {LoadMoreContext} ctx
     * @returns {Promise<void>}
     */
    const loadNextBatch = async (ctx) => {
        if (ctx.isLoading) {
            return;
        }

        ctx.isLoading = true;
        ctx.hasLoadError = false;
        updateLoadMoreControl(ctx);
        updateLoadMoreStatus(ctx);

        try {
            const { items, nextOffset } = await requestNextBatch(ctx);
            appendBatchItems(ctx, items);
            ctx.nextOffset = nextOffset;

            if (items.length === 0 && ctx.total > 0 && ctx.loadedCount < ctx.total) {
                ctx.loadedCount = ctx.total;
            }
        } catch (error) {
            ctx.hasLoadError = true;
            if (ctx.control instanceof HTMLAnchorElement && ctx.control.href) {
                window.location.href = ctx.control.href;
                return;
            }
        } finally {
            ctx.isLoading = false;
            updateLoadMoreControl(ctx);
            updateLoadMoreStatus(ctx);
        }
    };

    /**
     * Controlador de click sobre el enlace/boton de carga.
     * @param {MouseEvent} event
     * @param {LoadMoreContext} ctx
     * @returns {void}
     */
    const handleLoadMoreClick = (event, ctx) => {
        event.preventDefault();

        const isDisabled = ctx.control.getAttribute('aria-disabled') === 'true';
        if (ctx.isLoading || isDisabled) {
            return;
        }

        loadNextBatch(ctx);
    };

    /**
     * Inicializa la funcionalidad de carga progresiva de galeria hogar.
     * @returns {void}
     */
    const initLoadMoreGallery = () => {
        const loadMoreCtx = buildLoadMoreContext();
        if (!loadMoreCtx) {
            return;
        }

        loadMoreCtx.control.addEventListener('click', (event) => {
            handleLoadMoreClick(event, loadMoreCtx);
        });

        updateLoadMoreControl(loadMoreCtx);
        updateLoadMoreStatus(loadMoreCtx);
    };

    /** LIGHTBOX **/

    /**
    * Crea el visor lightbox y devuelve una función para abrirlo con un conjunto de imágenes.
     * @returns {{ open: (galleryItems: Array<{href: string, alt: string, caption: string}>, index?: number) => void }}
     */
    const createLightbox = () => {
        let items = [];
        let currentIndex = 0;
        let lastFocused = null;

        const root = document.createElement('div');
        root.className = 'lightbox';
        root.setAttribute('role', 'dialog');
        root.setAttribute('aria-modal', 'true');
        root.setAttribute('aria-label', 'Visor de imágenes');
        root.hidden = true;

        root.innerHTML = `  
      <div class="lightbox__backdrop" data-lightbox-close></div>
      <div class="lightbox__content" role="document">
        <button class="lightbox__close" type="button" aria-label="Cerrar imagen">×</button>
        <button class="lightbox__nav lightbox__nav--prev" type="button" aria-label="Imagen anterior">‹</button>
        <div class="lightbox__frame">
          <img class="lightbox__image" src="" alt="" />
          <div class="lightbox__caption" aria-live="polite"></div>
        </div>
        <button class="lightbox__nav lightbox__nav--next" type="button" aria-label="Imagen siguiente">›</button>
      </div>
    `;
        document.body.appendChild(root);

        const imageEl = root.querySelector('.lightbox__image');
        const captionEl = root.querySelector('.lightbox__caption');
        const closeBtn = root.querySelector('.lightbox__close');
        const prevBtn = root.querySelector('.lightbox__nav--prev');
        const nextBtn = root.querySelector('.lightbox__nav--next');

        // Actualiza la imagen, el texto alternativo, la leyenda y el estado de los controles de navegación.
        const updateUI = () => {
            const item = items[currentIndex];
            if (!item) return;
            imageEl.src = item.href;
            imageEl.alt = item.alt || item.caption || 'Imagen de galería';
            captionEl.textContent = item.caption || '';
            prevBtn.disabled = currentIndex === 0;
            nextBtn.disabled = currentIndex === items.length - 1;
        };

        // Abre el lightbox con un conjunto de elementos y un índice inicial.
        const open = (galleryItems, index = 0) => {
            if (!galleryItems || !galleryItems.length) return;
            items = galleryItems;
            currentIndex = Math.min(Math.max(index, 0), items.length - 1);

            lastFocused = document.activeElement;
            updateUI();
            root.hidden = false;
            root.classList.add('lightbox--open');

            // El foco salta al botón de cierre para que el diálogo sea navegable por teclado.
            closeBtn.focus();
            document.addEventListener('keydown', handleKeydown);
        };

        // Cierra el lightbox y restaura el foco al elemento que lo abrió.
        const close = () => {
            root.hidden = true;
            root.classList.remove('lightbox--open');
            document.removeEventListener('keydown', handleKeydown);
            if (lastFocused instanceof HTMLElement) {
                lastFocused.focus();
            }
        };

        // Navega a la imagen anterior.
        const prev = () => {
            if (currentIndex > 0) {
                currentIndex -= 1;
                updateUI();
            }
        };

        // Navega a la imagen siguiente.
        const next = () => {
            if (currentIndex < items.length - 1) {
                currentIndex += 1;
                updateUI();
            }
        };

        // Maneja eventos de teclado para navegación y cierre.
        const handleKeydown = (event) => {
            if (root.hidden) return;
            switch (event.key) {
                case 'Escape':
                    event.preventDefault();
                    close();
                    break;
                case 'ArrowLeft':
                    event.preventDefault();
                    prev();
                    break;
                case 'ArrowRight':
                    event.preventDefault();
                    next();
                    break;
                default:
                    break;
            }
        };

        // Cierra al hacer click fuera de la fotografia o en los controles de cierre.
        const handleClick = (event) => {
            const target = event.target;

            // Clic en backdrop o boton de cierre.
            if (target.matches('[data-lightbox-close]') || target.closest('.lightbox__close')) {
                close();
                return;
            }

            // Mantiene la navegacion operativa sin cerrar el lightbox.
            if (target.closest('.lightbox__nav')) {
                return;
            }

            // Si el clic no cae sobre la imagen, se interpreta como "fuera" y se cierra.
            if (!target.closest('.lightbox__image')) {
                close();
            }
        };

        root.addEventListener('click', handleClick);
        closeBtn.addEventListener('click', close);
        prevBtn.addEventListener('click', prev);
        nextBtn.addEventListener('click', next);

        return { open };
    };

    /**
     * Devuelve enlaces visibles dentro de una galeria.
     * @param {Element} gallery
     * @returns {HTMLAnchorElement[]}
     */
    const getVisibleGalleryLinks = (gallery) => {
        return (Array.from(gallery.querySelectorAll('a')).filter((link) => {
            return !link.closest('[hidden]');
        }));
    };

    /**
     * Convierte enlaces de una galeria en elementos navegables por el lightbox.
     * @param {HTMLAnchorElement[]} links
     * @returns {Array<{href: string, alt: string, caption: string}>}
     */
    const mapLinksToLightboxItems = (links) => {
        return links.map((link) => {
            const figure = link.closest('figure');
            const caption = figure?.querySelector('figcaption')?.textContent?.trim() || '';
            const img = link.querySelector('img');

            return {
                href: link.href,
                alt: img?.alt?.trim() || '',
                caption,
            };
        });
    };

    /**
     * Enlaza todas las galerias de la pagina con el lightbox.
     * @returns {void}
     */
    const initLightboxForGalleries = () => {
        const lightbox = createLightbox();

        document.querySelectorAll('.gallery').forEach((gallery) => {
            gallery.addEventListener('click', (event) => {
                const link = event.target.closest('a');
                if (!link || !gallery.contains(link)) return;

                const visibleLinks = getVisibleGalleryLinks(gallery);
                const index = visibleLinks.indexOf(link);
                if (index === -1) return;

                event.preventDefault();
                lightbox.open(mapLinksToLightboxItems(visibleLinks), index);
            });
        });
    };

    /** MENU MOVIL **/

    /**
     * Sincroniza atributos accesibles del menu movil compartido.
     * @returns {void}
     */
    const initMobileMenu = () => {
        const toggle = document.getElementById('menu-toggle');
        const nav = document.getElementById('main-navigation');

        if (!(toggle instanceof HTMLInputElement) || !(nav instanceof HTMLElement)) {
            return;
        }

        const syncMenuState = () => {
            const isExpanded = toggle.checked;
            toggle.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');

            if (window.innerWidth <= 900) {
                nav.setAttribute('aria-hidden', isExpanded ? 'false' : 'true');
            } else {
                nav.removeAttribute('aria-hidden');
            }
        };

        toggle.addEventListener('change', syncMenuState);
        window.addEventListener('resize', syncMenuState);
        syncMenuState();
    };

    /** PUNTO DE ENTRADA **/

    /**
     * Punto de entrada al cargar el DOM.
     * @returns {void}
     */
    const init = () => {
        initMobileMenu();
        initLoadMoreGallery();
        initLightboxForGalleries();
    };

    document.addEventListener('DOMContentLoaded', init);
})();
