/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                "primary":          "var(--color-primary)",
                "primary-dark":     "var(--color-primary-dark)",
                "primary-muted":    "var(--color-primary-muted)",
                "primary-deep":     "var(--color-primary-deep)",
                "primary-light":    "var(--color-primary-light)",
                "background-light": "#ffffff",
                "background-dark":  "#1a1a1a",
            },
            fontFamily: { "display": ["Inter"] },
            borderRadius: {
                "DEFAULT": "0.25rem",
                "lg":      "0.5rem",
                "xl":      "0.75rem",
                "full":    "9999px"
            },
        },
    },
    plugins: [],
}