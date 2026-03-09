<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary":          "{{ $config['primary'] }}",
                    "primary-dark":     "{{ $config['primary-dark'] }}",
                    "primary-muted":    "{{ $config['primary-muted'] }}",
                    "primary-deep":     "{{ $config['primary-deep'] }}",
                    "primary-light":    "{{ $config['primary-light'] }}",
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
    }
</script>