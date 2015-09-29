module.exports = function (grunt) {
    grunt.initConfig({
        less: {
            dev: {
                options: {
                    compress: false,
                    sourceMap: true,
                    outputSourceFiles: true
                },
                files: {
                    "frontend/web/css/all.css": "frontend/assets/less/all.less"
                }
            },
            prod: {
                options: {
                    compress: true
                },
                files: {
                    "frontend/web/css/all.min.css": "frontend/assets/less/all.less"
                }
            }            
        },
        concat_sourcemap: {
            options: {
                sourcesContent: false
            },
            lib: {
                files: {
                    'frontend/web/js/lib.js': grunt.file.readJSON('frontend/assets/js/lib.json')
                }
            },
            all: {
                files: {
                    'frontend/web/js/all.js': grunt.file.readJSON('frontend/assets/js/all.json')
                }
            }            
        },
        copy: {
            main: {
                files: [
                    {expand: true, flatten: true, src: ['vendor/bower/bootstrap/fonts/*'], dest: 'frontend/web/fonts/', filter: 'isFile'}
                ]
            },            
        },
        uglify: {
            /*options: {
             mangle: false
             },*/
            lib: {
                files: {
                    'frontend/web/js/lib.min.js': 'frontend/web/js/lib.js'
                }
            },
            all: {
                files: {
                    'frontend/web/js/all.min.js': 'frontend/web/js/all.js'
                }
            }
        },
        watch: {
            js_lib: {
                files: ['frontend/assets/js/lib.json', 'frontend/assets/js/lib/**/*.js'],
                tasks: ['concat_sourcemap:lib', 'uglify:lib'],
                options: {
                    livereload: true
                }
            },
            js_all: {
                files: ['frontend/assets/js/all.json', 'frontend/assets/js/all/**/*.js'],
                tasks: ['concat_sourcemap:all', 'uglify:all'],
                options: {
                    livereload: true
                }
            },
            less: {
                files: ['frontend/assets/less/**/*.less'],
                tasks: ['less:dev', 'less:prod'],
                options: {
                    livereload: true
                }
            },            
            fonts: {
                files: [
                    'vendor/bower/bootstrap/fonts/*'
                ],
                tasks: ['copy'],
                options: {
                    livereload: true
                }
            }
        }
    });
    // Plugin loading    
    grunt.loadNpmTasks('grunt-concat-sourcemap');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');
    // Task definition
    grunt.registerTask('build', ['concat_sourcemap', 'less', 'copy', 'uglify']);
    grunt.registerTask('default', ['watch']);
};