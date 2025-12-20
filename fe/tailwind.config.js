/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './src/**/*.{js,jsx,ts,tsx,scss,php}',
        '../**/*.php',
        '../blocks/**/*.{js,jsx,ts,tsx,php}',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['IBM Plex Sans', 'sans-serif'],
            },
            colors: {
                'se-dark-navy': '#1C3664',
                'se-yellow': '#FCC937',
                'data-blue': '#2E7BFF',
                'deep-blue': '#172C52',
                'mid-blue': '#264987',
                'input-border': '#86A4C6',
                'very-dark-blue': '#11213F',
                'se-yellow-hover': '#FFC51E',
                'yellow-illuminate': '#FFEC72',
            },
            keyframes: {
                fadeInUp: {
                    '0%': {
                        opacity: '0',
                        transform: 'translateY(40px)',
                    },
                    '100%': {
                        opacity: '1',
                        transform: 'translateY(0)',
                    },
                },
                fadeOut: {
                    '0%': {
                        opacity: '1',
                    },
                    '100%': {
                        opacity: '0',
                    },
                },
                marquee: {
                    '0%': { transform: 'translateX(0)' },
                    '100%': { transform: 'translateX(-20%)' },
                },
            },
            animation: {
                'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                'fade-out': 'fadeOut 0.1s ease-in forwards',
                'marquee': 'marquee 5s linear infinite',
            },
        },
    },
    plugins: [],
};
