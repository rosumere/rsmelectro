const { src, dest, watch, series, parallel } = require("gulp");
const sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const sourcemaps = require("gulp-sourcemaps");
const rename = require('gulp-rename');
const sortMediaQueries = require('postcss-sort-media-queries');
const gulpif = require("gulp-if");
const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify-es').default;

// Destination folder
const destFolder = 'assets';
let isProd = false;


function styles() {
  return src("_src/sass/style.scss")
    .pipe(gulpif(!isProd, sourcemaps.init()))
    .pipe(sass({
      silenceDeprecations: ['legacy-js-api', 'mixed-decls', 'color-functions', 'global-builtin', 'import'],
    }))
    .pipe(gulpif(isProd, (postcss([sortMediaQueries({ sort: 'mobile-first' })]))))
    .pipe(postcss([autoprefixer()]))
    .pipe(cleanCSS({ level: 2 }))
    .pipe(rename({ suffix: ".min" }))
    .pipe(gulpif(!isProd, sourcemaps.write(".")))
    .pipe(dest(destFolder + '/css/'));
}
exports.styles = styles;

/**
 * Main scripts
 */
function scripts() {
  return src('_src/js/main.js')
    .pipe(uglify())
    .pipe(concat('main.min.js'))
    .pipe(dest(destFolder + '/js/'))
}
exports.scripts = scripts;

function watching() {
  watch(['_src/sass/**/*.scss'], parallel(styles));
  watch(['_src/js/main.js'], parallel(scripts));
}
exports.watching = watching;

exports.default = parallel(styles, scripts, watching);
