import scss from 'rollup-plugin-scss';
import { terser } from "rollup-plugin-terser";

//Project setup: bundle.js (compiled from main.js) and bundle.css (compiled from styles.scss)

export default {
    input: 'src/main.js',
    output: {
        file: 'dist/bundle.js',
        format: 'iife',
        name: 'main'
    },
    plugins: [
        scss({
            outputStyle: 'compressed'
        }),
        terser()
    ]
}