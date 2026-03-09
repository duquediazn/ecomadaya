import os
import re
from pathlib import Path

def normalize_filename(filename):
    """Normalize filename: remove accents and replace spaces with underscores"""
    # Remove accents
    filename = re.sub(r'[áàäâ]', 'a', filename)
    filename = re.sub(r'[éèëê]', 'e', filename)
    filename = re.sub(r'[íìïî]', 'i', filename)
    filename = re.sub(r'[óòöô]', 'o', filename)
    filename = re.sub(r'[úùüû]', 'u', filename)
    filename = re.sub(r'[ñ]', 'n', filename)
    
    # Replace spaces with underscores
    filename = filename.replace(' ', '_')
    
    return filename

def rename_images(folder_path):
    """Rename all images in the specified folder"""
    if not os.path.exists(folder_path):
        print(f"Error: La carpeta '{folder_path}' no existe.")
        return
    
    renamed_count = 0
    
    for filename in os.listdir(folder_path):
        filepath = os.path.join(folder_path, filename)
        
        # Only process files, not directories
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

# Change the path to your images folder
rename_images('')
