module.exports = function(grunt) {

    grunt.initConfig({

        // merge minify js
        uglify: {

            global: {
                options: {
                    banner: '/* http://lorem.in  @author LoeiFy@gmail.com */ \n'
                },
                files: {
                    'dist/Diaspora.js': [
                        'assets/Diaspora.js'
                    ]
                }
            }

        },

        // concat js
        concat: {

            plugin: {

                options: {
                    banner: 'window.DP={};\n'
                },

                files: {
                    'dist/plugin.js': [
                        'assets/Chocolate.js',
                        'assets/jquery.justifiedGallery.min.js',
                        'assets/jquery.parallax.js',
                        'assets/jquery.qrcode.min.js',
                        'assets/Vibrant.js'
                    ]
                }

            }

        },

        // merge minify css
        cssmin: {

            global: {
                options: {
                    banner: '/* http://lorem.in  @author LoeiFy@gmail.com */ \n'
                },
                files: {
                    'dist/Diaspora.css': [
                        'assets/Diaspora.css',
                        'assets/icon.css'
                    ],
                    'dist/base.css': [
                        'assets/base.css'
                    ]
                }
            }

        },

        // replace string
        replace: {

            basket: {
                options: {
                    patterns: [
                        {
                            match: 'css',
                            replacement: '<%= grunt.file.read("dist/base.css") %>'
                        },
                        {
                            match: 'static',
                            replacement: '<%= grunt.file.read("assets/basket.html") %>'
                        }
                    ]
                },
                files: [
                    {src: ['assets/header.php'], dest: 'header.php'}
                ]
            },

            dev: {
                options: {
                    patterns: [
                        {
                            match: 'css',
                            replacement: ''
                        },
                        {
                            match: 'static',
                            replacement: '<%= grunt.file.read("assets/dev.html") %>'
                        }
                    ]
                },
                files: [
                    {src: ['assets/header.php'], dest: 'header.php'}
                ]
            }

        }

    });

    // grunt plugin
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-replace');
    grunt.loadNpmTasks('grunt-contrib-concat');

    grunt.registerTask('default', ['uglify', 'concat', 'cssmin', 'replace:basket']);
    grunt.registerTask('dev', ['replace:dev']);

};
