/* Lightbox para imágenes de las galerías de servicios.
   - Abre la imagen en un overlay.
   - Permite navegación entre las imágenes de la misma galería.
   - Cierra con X, Esc, o clic fuera de la imagen.
*/

(function () {
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

        const updateUI = () => {
            const item = items[currentIndex];
            if (!item) return;
            imageEl.src = item.href;
            imageEl.alt = item.alt || item.caption || 'Imagen de galería';
            captionEl.textContent = item.caption || '';
            prevBtn.disabled = currentIndex === 0;
            nextBtn.disabled = currentIndex === items.length - 1;
        };

        const open = (galleryItems, index = 0) => {
            if (!galleryItems || !galleryItems.length) return;
            items = galleryItems;
            currentIndex = Math.min(Math.max(index, 0), items.length - 1);

            lastFocused = document.activeElement;
            updateUI();
            root.hidden = false;
            root.classList.add('lightbox--open');

            // Focus management
            closeBtn.focus();
            document.addEventListener('keydown', handleKeydown);
        };

        const close = () => {
            root.hidden = true;
            root.classList.remove('lightbox--open');
            document.removeEventListener('keydown', handleKeydown);
            if (lastFocused instanceof HTMLElement) {
                lastFocused.focus();
            }
        };

        const prev = () => {
            if (currentIndex > 0) {
                currentIndex -= 1;
                updateUI();
            }
        };

        const next = () => {
            if (currentIndex < items.length - 1) {
                currentIndex += 1;
                updateUI();
            }
        };

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

        const handleClick = (event) => {
            const target = event.target;
            if (target.matches('[data-lightbox-close]') || target.closest('.lightbox__close')) {
                close();
            }
        };

        root.addEventListener('click', handleClick);
        closeBtn.addEventListener('click', close);
        prevBtn.addEventListener('click', prev);
        nextBtn.addEventListener('click', next);

        return { open };
    };

    const init = () => {
        const lightbox = createLightbox();

        document.querySelectorAll('.gallery').forEach((gallery) => {
            gallery.addEventListener('click', (event) => {
                const link = event.target.closest('a');
                if (!link || !gallery.contains(link)) return;

                const figures = Array.from(gallery.querySelectorAll('a'));
                const items = figures.map((a) => {
                    const figure = a.closest('figure');
                    const caption = figure?.querySelector('figcaption')?.textContent?.trim() || '';
                    const img = a.querySelector('img');
                    return {
                        href: a.href,
                        alt: img?.alt?.trim() || '',
                        caption,
                    };
                });

                const index = figures.indexOf(link);
                if (index === -1) return;

                event.preventDefault();
                lightbox.open(items, index);
            });
        });
    };

    document.addEventListener('DOMContentLoaded', init);
})();
