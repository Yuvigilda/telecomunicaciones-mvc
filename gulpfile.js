// import{dest, src, watch, series} from 'gulp'
// import * as dartsass from 'sass'
// import gulpSass from 'gulp-sass'

// import {glob} from 'glob';
// import sharp from 'sharp';
// import  path from 'path';
// import sourcemaps from 'gulp-sourcemaps';
// import concat from 'gulp-concat';
// import terser from 'gulp-terser-js';
// import rename from 'gulp-rename';
// import fs from 'fs';

// const sass = gulpSass(dartsass);

// export function css(done){
//     src('src/scss/app.scss')
//         .pipe(sass().on('error', sass.logError))
//         .pipe(dest('build/css'))
//     done();
// }
// export async function imagenes(done) {
//     const srcDir = './src/img';
//     const buildDir = './build/img';
//     const images =  await glob('./src/img/**/*{jpg,png}')

//     images.forEach(file => {
//         const relativePath = path.relative(srcDir, path.dirname(file));
//         const outputSubDir = path.join(buildDir, relativePath);
//         procesarImagenes(file, outputSubDir);
//     });
//     done();
// }
// function javascript() {
//     return src('src/js/**/*.js')
//       .pipe(sourcemaps.init())
//       .pipe(concat('bundle.js'))
//       .pipe(terser())
//       .pipe(sourcemaps.write('.'))
//       .pipe(rename({ suffix: '.min' }))
//       .pipe(dest('./build/js'))
// }
// function procesarImagenes(file, outputSubDir) {
//     if (!fs.existsSync(outputSubDir)) {
//         fs.mkdirSync(outputSubDir, { recursive: true })
//     }
//     const baseName = path.basename(file, path.extname(file))
//     const extName = path.extname(file)
//     const outputFile = path.join(outputSubDir, `${baseName}${extName}`)
//     const outputFileWebp = path.join(outputSubDir, `${baseName}.webp`)
//     const outputFileAvif = path.join(outputSubDir, `${baseName}.avif`)

//     const options = { quality: 80 }
//     sharp(file).jpeg(options).toFile(outputFile)
//     sharp(file).webp(options).toFile(outputFileWebp)
//     sharp(file).avif().toFile(outputFileAvif)
// }

// export function dev(){
//     watch('src/scss/**/*.scss',css );
//      watch('src/js/**/*.js',javascript );
// }

// export default series(javascript,dev);

import path from 'path'
import fs from 'fs'
import { glob } from 'glob'
import { src, dest, watch, series } from 'gulp'
import * as dartSass from 'sass'
import gulpSass from 'gulp-sass'
import terser from 'gulp-terser'
import sharp from 'sharp'

const sass = gulpSass(dartSass)

const paths = {
    scss: 'src/scss//*.scss',
    js: 'src/js//*.js'
}

export function css( done ) {
    src(paths.scss, {sourcemaps: true})
        .pipe( sass({
            outputStyle: 'compressed'
        }).on('error', sass.logError) )
        .pipe( dest('./public/build/css', {sourcemaps: '.'}) );
    done()
}

export function js( done ) {
    src(paths.js)
      .pipe(terser())
      .pipe(dest('./public/build/js'))
    done()
}

export async function imagenes(done) {
    const srcDir = './src/img';
    const buildDir = './public/build/img';
    const images =  await glob('./src/img//*')

    images.forEach(file => {
        const relativePath = path.relative(srcDir, path.dirname(file));
        const outputSubDir = path.join(buildDir, relativePath);
        procesarImagenes(file, outputSubDir);
    });
    done();
}

function procesarImagenes(file, outputSubDir) {
    if (!fs.existsSync(outputSubDir)) {
        fs.mkdirSync(outputSubDir, { recursive: true })
    }
    const baseName = path.basename(file, path.extname(file))
    const extName = path.extname(file)

    if (extName.toLowerCase() === '.svg') {
        // If it's an SVG file, move it to the output directory
        const outputFile = path.join(outputSubDir, `${baseName}${extName}`);
    fs.copyFileSync(file, outputFile);
    } else {
        // For other image formats, process them with sharp
        const outputFile = path.join(outputSubDir, `${baseName}${extName}`);
        const outputFileWebp = path.join(outputSubDir, `${baseName}.webp`);
        const outputFileAvif = path.join(outputSubDir, `${baseName}.avif`);
        const options = { quality: 80 };

        sharp(file).jpeg(options).toFile(outputFile);
        sharp(file).webp(options).toFile(outputFileWebp);
        sharp(file).avif().toFile(outputFileAvif);
    }
}

export function dev() {
    watch( paths.scss, css );
    watch( paths.js, js );
    watch('src/img//*.{png,jpg}', imagenes)
}

export default series( js, css, imagenes, dev )
