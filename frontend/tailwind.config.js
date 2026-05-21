/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          50: '#fef2f2',
          100: '#fee2e2',
          200: '#fecaca',
          300: '#fca5a5',
          400: '#f87171',
          500: '#e53935',
          600: '#d7241b',
          700: '#cb0000',
          800: '#a10000',
          900: '#7f0000',
        },
        // Aliased to brand red so existing utility usage maps to new palette without per-file rewrites
        primary: {
          50: '#fef2f2',
          100: '#fee2e2',
          200: '#fecaca',
          300: '#fca5a5',
          400: '#f87171',
          500: '#e53935',
          600: '#d7241b',
          700: '#cb0000',
          800: '#a10000',
          900: '#7f0000',
        },
        secondary: {
          50: '#f8fafc',
          100: '#f1f5f9',
          200: '#e2e8f0',
          300: '#cbd5e1',
          400: '#94a3b8',
          500: '#64748b',
          600: '#475569',
          700: '#334155',
          800: '#1e293b',
          900: '#0f172a',
        },
        accent: {
          50: '#fef2f2',
          100: '#fee2e2',
          200: '#fecaca',
          300: '#fca5a5',
          400: '#f87171',
          500: '#e53935',
          600: '#d7241b',
          700: '#cb0000',
          800: '#a10000',
          900: '#7f0000',
        },
        // Inverted: `dark-*` numbers map to LIGHT shades so legacy class names produce a light theme
        dark: {
          50: '#0f172a',
          100: '#1e293b',
          200: '#334155',
          300: '#475569',
          400: '#64748b',
          500: '#94a3b8',
          600: '#e2e8f0',
          700: '#f1f5f9',
          800: '#f8fafc',
          900: '#ffffff',
          950: '#ffffff',
        },
      },
      fontFamily: {
        sans: ['"Open Sans"', 'system-ui', 'sans-serif'],
      },
      backgroundImage: {
        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
        'hero-gradient': 'linear-gradient(135deg, #ffffff 0%, #f8fafc 100%)',
      },
    },
  },
  plugins: [],
}
