import os
import re
from pathlib import Path

def normalize_filename(filename):
    """Normaliza el nombre del archivo: elimina acentos y reemplaza espacios por guiones bajos"""
    # Eliminar acentos
    filename = re.sub(r'[áàäâ]', 'a', filename)
    filename = re.sub(r'[éèëê]', 'e', filename)
    filename = re.sub(r'[íìïî]', 'i', filename)
    filename = re.sub(r'[óòöô]', 'o', filename)
    filename = re.sub(r'[úùüû]', 'u', filename)
    filename = re.sub(r'[ñ]', 'n', filename)
    
    # Reemplazar espacios por guiones bajos
    filename = filename.replace(' ', '_')
    
    return filename

def rename_images(folder_path):
    """Renombra todas las imágenes en la carpeta especificada"""
    if not os.path.exists(folder_path):
        print(f"Error: La carpeta '{folder_path}' no existe.")
        return
    
    renamed_count = 0
    
    for filename in os.listdir(folder_path):
        filepath = os.path.join(folder_path, filename)
        
        # Solo procesar archivos, no directorios
        if os.path.isfile(filepath):
            name, ext = os.path.splitext(filename)
            normalized_name = normalize_filename(name)
            new_filename = normalized_name + ext
            
            if new_filename != filename: 
                new_filepath = os.path.join(folder_path, new_filename)
                try:
                    os.rename(filepath, new_filepath)
                    print(f"✓ '{filename}' → '{new_filename}'")
                    renamed_count += 1
                except Exception as e:
                    print(f"✗ Error renombrando '{filename}': {e}")
    
    print(f"\nTotal archivos renombrados: {renamed_count}")

# Pon la ruta de la carpeta que contiene las imágenes a renombrar
# Ejemplo: rename_images('/public/assets/img/galeria/hogar')
rename_images('')
