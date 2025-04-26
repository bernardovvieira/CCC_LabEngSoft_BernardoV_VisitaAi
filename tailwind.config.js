import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
  ],

  theme: {
    extend: {
      // Mantém suas fontes customizadas
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
      // Define espaçamentos reutilizáveis (ex: largura da sidebar)
      spacing: {
        sidebar: '16rem',      // classes: w-sidebar, px-sidebar etc.
      },
    },
    // Configurações globais de container
    container: {
      center: true,
      padding: {
        DEFAULT: '1rem',
        sm: '2rem',
        lg: '4rem',
      },
    },
  },

  plugins: [
    forms,                  // plugin de formulários
  ],
};
