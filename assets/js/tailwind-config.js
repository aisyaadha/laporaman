// ============================================
// KONFIGURASI TEMA TAILWIND
// (Warna brand & font kustom)
// ============================================

tailwind.config = {
    theme: {
        extend: {
            colors: {
                brand: {
                    blue: '#1E3A8A',     // Primary Blue
                    blueDark: '#172554',
                    emerald: '#059669',  // Secondary Green
                    red: '#DC2626',      // Red Alert / Danger
                    yellow: '#D97706',   // Warning Yellow
                    dark: '#0F172A',     // Black / Deep Slate
                    light: '#FFFFFF'     // White
                }
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif']
            }
        }
    }
};