/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // Colores del tema claro
        'light-bg': '#f8fafc',
        'light-card': '#ffffff',
        'light-border': '#e2e8f0',
        'light-hover': '#f1f5f9',
        'light-text': '#1e293b',
        'light-text-secondary': '#64748b',
        
        // Colores de acento
        'accent-blue': '#3b82f6',
        'accent-blue-hover': '#2563eb',
        'accent-green': '#10b981',
        'accent-green-hover': '#059669',
        'accent-red': '#ef4444',
        'accent-red-hover': '#dc2626',
        'accent-yellow': '#f59e0b',
        'accent-yellow-hover': '#d97706',
        'accent-purple': '#8b5cf6',
        'accent-purple-hover': '#7c3aed',
      },
      fontFamily: {
        'sans': ['Roboto', 'sans-serif'],
      },
      boxShadow: {
        'soft': '0 2px 4px 0 rgba(0, 0, 0, 0.06)',
        'medium': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
      },
      borderRadius: {
        'xl': '1rem',
        '2xl': '1.5rem',
      },
      animation: {
        'bounce-slow': 'bounce 2s infinite',
        'pulse-slow': 'pulse 3s infinite',
      },
    },
  },
  plugins: [],
} 