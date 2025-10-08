const { src, dest, watch, series, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const sourcemaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const terser = require('gulp-terser-js');
const rename = require('gulp-rename');
const imagemin = require('gulp-imagemin');
const cache = require('gulp-cache');
const notify = require('gulp-notify');
const webp = require('gulp-webp');
const modernizr = require('modernizr');
const fs = require('fs');

// Rutas
const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    modernizr: 'src/js/modernizr.js', // Modernizr generado
    imagenes: 'src/img/**/*'
};

// ======= CSS =======
function css() {
    return src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('build/css'));
}

// ======= JavaScript =======
function javascript() {
    return src([paths.js, `!${paths.modernizr}`]) // excluye Modernizr
        .pipe(sourcemaps.init())
        .pipe(concat('bundle.js'))
        .pipe(terser({ mangle: false })) // mantiene nombres globales
        .pipe(sourcemaps.write('.'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(dest('build/js'));
}

// ======= Generar Modernizr actualizado =======
function buildModernizr(cb) {
    modernizr.build({
        options: ['setClasses'],   // agrega clases .webp/.no-webp
        'feature-detects': ['img/webp']
    }, function(result) {
        fs.writeFileSync(paths.modernizr, result);
        cb();
    });
}

// ======= Copiar Modernizr al build =======
function copiarModernizr() {
    return src(paths.modernizr)
        .pipe(dest('build/js'));
}

// ======= Imágenes =======
function imagenes() {
    return src(paths.imagenes)
        .pipe(cache(imagemin({ optimizationLevel: 3 })))
        .pipe(dest('build/img'))
        .pipe(notify({ message: 'Imágenes optimizadas' }));
}

// ======= WebP =======
function versionWebp() {
    return src(paths.imagenes)
        .pipe(webp())
        .pipe(dest('build/img'))
        .pipe(notify({ message: 'WebP generado' }));
}

// ======= Watcher =======
function watchArchivos() {
    watch(paths.scss, css);
    watch([paths.js, `!${paths.modernizr}`], javascript);
    watch(paths.modernizr, copiarModernizr);
    watch(paths.imagenes, imagenes);
    watch(paths.imagenes, versionWebp);
}

// ======= Tareas combinadas =======
const modernizrTask = series(buildModernizr, copiarModernizr);

// ======= Exports =======
exports.css = css;
exports.javascript = javascript;
exports.modernizr = modernizrTask;
exports.imagenes = imagenes;
exports.versionWebp = versionWebp;
exports.watch = watchArchivos;
exports.default = parallel(css, modernizrTask, javascript, imagenes, versionWebp, watchArchivos);
