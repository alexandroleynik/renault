module.exports = function (grunt) {
    grunt.initConfig({
        concat: {
            dist: {
                src: ['frontend/web/js/*.js'],
                dest: 'frontend/web/dist/js/all.js'
            }
        },
        uglify: {
            dist: {
                options: {
                    banner: '/* @author Eugene Fabrikov <eugene.fabrikov@gmail.com> */\n'
                }
            },
            files: {
                'frontend/web/dist/js/all.min.js': ['frontend/web/dist/js/all.js']
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    grunt.registerTask('default', ['concat', 'uglify']);

};