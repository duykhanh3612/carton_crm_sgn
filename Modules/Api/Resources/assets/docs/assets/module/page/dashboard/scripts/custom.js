setTimeout(function() {
    var _0xa9b7x1 = document['getElementById']('preloader');
    if (_0xa9b7x1) {
        _0xa9b7x1['classList']['add']('preloader-hide')
    }
}, 150);
document['addEventListener']('DOMContentLoaded', () => {
    'use strict';
    let _0xa9b7x2 = true;
    let _0xa9b7x3 = true;
    var _0xa9b7x4 = 'Kolor';
    var _0xa9b7x5 = 1;
    var _0xa9b7x6 = false;
    var _0xa9b7x7 = 'https://www.enableds.com/products/kolor/v41/';
    var _0xa9b7x8 = 'https://www.enableds.com/products/kolor/v41/_service-worker.js';

    function _0xa9b7x9() {
        var _0xa9b7xa, _0xa9b7xb, _0xa9b7xc;
        var _0xa9b7xd = document['getElementsByClassName']('menu-hider');
        if (!_0xa9b7xd['length']) {
            document['body']['innerHTML'] += '<div class=\"menu-hider\"></div>'
        };
        if (_0xa9b7xd[0]['classList']['contains']('menu-active')) {
            _0xa9b7xd[0]['classList']['remove']('menu-active')
        };
        var _0xa9b7xe = document['querySelectorAll']('#footer-bar');
        if (_0xa9b7xe['length']) {
            var _0xa9b7xf = document['querySelectorAll']('.page-content');
            _0xa9b7xf[0]['classList']['add']('has-footer-menu')
        };
        document['querySelectorAll']('.menu')['forEach']((_0xa9b7xc) => {
            _0xa9b7xc['style']['display'] = 'block'
        });
        var _0xa9b7x10 = document['querySelectorAll']('input');
        if (_0xa9b7x10['length']) {
            var _0xa9b7x11 = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            var _0xa9b7x12 = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;
            var _0xa9b7x13 = /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u;
            var _0xa9b7x14 = /[A-Za-z]{2}[A-Za-z]*[ ]?[A-Za-z]*/;
            var _0xa9b7x15 = /^(0|[1-9]\d*)$/;
            var _0xa9b7x16 = /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
            var _0xa9b7x17 = /[A-Za-z]{2}[A-Za-z]*[ ]?[A-Za-z]*/;

            function _0xa9b7x18(_0xa9b7xc) {
                _0xa9b7xc['parentElement']['querySelectorAll']('.valid')[0]['classList']['remove']('disabled');
                _0xa9b7xc['parentElement']['querySelectorAll']('.invalid')[0]['classList']['add']('disabled')
            }

            function _0xa9b7x19(_0xa9b7xc) {
                _0xa9b7xc['parentElement']['querySelectorAll']('.valid')[0]['classList']['add']('disabled');
                _0xa9b7xc['parentElement']['querySelectorAll']('.invalid')[0]['classList']['remove']('disabled')
            }

            function _0xa9b7x1a(_0xa9b7xc) {
                _0xa9b7xc['parentElement']['querySelectorAll']('em')[0]['classList']['remove']('disabled');
                _0xa9b7xc['parentElement']['querySelectorAll']('.valid')[0]['classList']['add']('disabled');
                _0xa9b7xc['parentElement']['querySelectorAll']('.invalid')[0]['classList']['add']('disabled')
            }
            var _0xa9b7x1b = document['querySelectorAll']('.input-style input:not([type=\"date\"])');
            _0xa9b7x1b['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('keyup', (_0xa9b7xb) => {
                    if (!_0xa9b7xc['value'] == '') {
                        _0xa9b7xc['parentElement']['classList']['add']('input-style-active');
                        _0xa9b7xc['parentElement']['querySelector']('em')['classList']['add']('disabled')
                    } else {
                        _0xa9b7xc['parentElement']['querySelectorAll']('.valid')[0]['classList']['add']('disabled');
                        _0xa9b7xc['parentElement']['querySelectorAll']('.invalid')[0]['classList']['add']('disabled');
                        _0xa9b7xc['parentElement']['classList']['remove']('input-style-active');
                        _0xa9b7xc['parentElement']['querySelector']('em')['classList']['remove']('disabled')
                    }
                })
            });
            var _0xa9b7x1c = document['querySelectorAll']('.input-style textarea');
            _0xa9b7x1c['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('keyup', (_0xa9b7xb) => {
                    if (!_0xa9b7xc['value'] == '') {
                        _0xa9b7xc['parentElement']['classList']['add']('input-style-active');
                        _0xa9b7xc['parentElement']['querySelector']('em')['classList']['add']('disabled')
                    } else {
                        _0xa9b7xc['parentElement']['classList']['remove']('input-style-active');
                        _0xa9b7xc['parentElement']['querySelector']('em')['classList']['remove']('disabled')
                    }
                })
            });
            var _0xa9b7x1d = document['querySelectorAll']('.input-style select');
            _0xa9b7x1d['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('change', (_0xa9b7xb) => {
                    if (_0xa9b7xc['value'] !== 'default') {
                        _0xa9b7xc['parentElement']['classList']['add']('input-style-active');
                        _0xa9b7xc['parentElement']['querySelectorAll']('.valid')[0]['classList']['remove']('disabled');
                        _0xa9b7xc['parentElement']['querySelectorAll']('.invalid, em, span')[0]['classList']['add']('disabled')
                    };
                    if (_0xa9b7xc['value'] == 'default') {
                        _0xa9b7xc['parentElement']['querySelectorAll']('span, .valid, em')[0]['classList']['add']('disabled');
                        _0xa9b7xc['parentElement']['querySelectorAll']('.invalid')[0]['classList']['remove']('disabled');
                        _0xa9b7xc['parentElement']['classList']['add']('input-style-active')
                    }
                })
            });
            var _0xa9b7x1e = document['querySelectorAll']('.input-style input[type=\"date\"]');
            _0xa9b7x1e['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('change', (_0xa9b7xb) => {
                    _0xa9b7xc['parentElement']['classList']['add']('input-style-active');
                    _0xa9b7xc['parentElement']['querySelectorAll']('.valid')[0]['classList']['remove']('disabled');
                    _0xa9b7xc['parentElement']['querySelectorAll']('.invalid')[0]['classList']['add']('disabled')
                })
            });
            var _0xa9b7x1f = document['querySelectorAll']('.validate-field input, .validator-field textarea');
            if (_0xa9b7x1f['length']) {
                _0xa9b7x1f['forEach']((_0xa9b7xc) => {
                    return _0xa9b7xc['addEventListener']('keyup', (_0xa9b7xb) => {
                        var _0xa9b7x20 = _0xa9b7xc['getAttribute']('type');
                        switch (_0xa9b7x20) {
                            case 'name':
                                _0xa9b7x13['test'](_0xa9b7xc['value']) ? _0xa9b7x18(_0xa9b7xc) : _0xa9b7x19(_0xa9b7xc);
                                break;
                            case 'number':
                                _0xa9b7x15['test'](_0xa9b7xc['value']) ? _0xa9b7x18(_0xa9b7xc) : _0xa9b7x19(_0xa9b7xc);
                                break;
                            case 'email':
                                _0xa9b7x11['test'](_0xa9b7xc['value']) ? _0xa9b7x18(_0xa9b7xc) : _0xa9b7x19(_0xa9b7xc);
                                break;
                            case 'text':
                                _0xa9b7x17['test'](_0xa9b7xc['value']) ? _0xa9b7x18(_0xa9b7xc) : _0xa9b7x19(_0xa9b7xc);
                                break;
                            case 'url':
                                _0xa9b7x16['test'](_0xa9b7xc['value']) ? _0xa9b7x18(_0xa9b7xc) : _0xa9b7x19(_0xa9b7xc);
                                break;
                            case 'tel':
                                _0xa9b7x12['test'](_0xa9b7xc['value']) ? _0xa9b7x18(_0xa9b7xc) : _0xa9b7x19(_0xa9b7xc);
                                break;
                            case 'password':
                                _0xa9b7x14['test'](_0xa9b7xc['value']) ? _0xa9b7x18(_0xa9b7xc) : _0xa9b7x19(_0xa9b7xc);
                                break
                        };
                        if (_0xa9b7xc['value'] === '') {
                            _0xa9b7x1a(_0xa9b7xc)
                        }
                    })
                })
            }
        };
        var _0xa9b7x21 = document['getElementsByClassName']('splide');
        if (_0xa9b7x21['length']) {
            var _0xa9b7x22 = document['querySelectorAll']('.single-slider');
            if (_0xa9b7x22['length']) {
                _0xa9b7x22['forEach'](function(_0xa9b7xb) {
                    var _0xa9b7x23 = new Splide('#' + _0xa9b7xb['id'], {
                        type: 'loop',
                        autoplay: true,
                        interval: 4000,
                        perPage: 1
                    })['mount']();
                    var _0xa9b7x24 = document['querySelectorAll']('.slider-next');
                    var _0xa9b7x25 = document['querySelectorAll']('.slider-prev');
                    _0xa9b7x24['forEach']((_0xa9b7xc) => {
                        return _0xa9b7xc['addEventListener']('click', (_0xa9b7xc) => {
                            _0xa9b7x23['go']('>')
                        })
                    });
                    _0xa9b7x25['forEach']((_0xa9b7xc) => {
                        return _0xa9b7xc['addEventListener']('click', (_0xa9b7xc) => {
                            _0xa9b7x23['go']('<')
                        })
                    })
                })
            };
            var _0xa9b7x26 = document['querySelectorAll']('.double-slider');
            if (_0xa9b7x26['length']) {
                _0xa9b7x26['forEach'](function(_0xa9b7xb) {
                    var _0xa9b7x27 = new Splide('#' + _0xa9b7xb['id'], {
                        type: 'loop',
                        autoplay: true,
                        interval: 4000,
                        arrows: false,
                        perPage: 2
                    })['mount']()
                })
            };
            var _0xa9b7x28 = document['querySelectorAll']('.tripple-slider');
            if (_0xa9b7x28['length']) {
                _0xa9b7x28['forEach'](function(_0xa9b7xb) {
                    var _0xa9b7x29 = new Splide('#' + _0xa9b7xb['id'], {
                        type: 'loop',
                        autoplay: true,
                        padding: {
                            left: '0px',
                            right: '80px'
                        },
                        interval: 4000,
                        arrows: false,
                        perPage: 2,
                        perMove: 1
                    })['mount']()
                })
            };
            var _0xa9b7x2a = document['querySelectorAll']('.story-slider');
            if (_0xa9b7x2a['length']) {
                var _0xa9b7x2b = new Splide('.story-slider', {
                    type: 'loop',
                    autoplay: false,
                    padding: {
                        left: '0px',
                        right: '40px'
                    },
                    arrows: false,
                    perPage: 4,
                    perMove: 1
                })['mount']()
            }
        };
        const _0xa9b7x2c = document['querySelectorAll']('a[href=\"#\"]');
        _0xa9b7x2c['forEach']((_0xa9b7xc) => {
            return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                _0xa9b7xb['preventDefault']();
                return false
            })
        });
        var _0xa9b7x2d = document['querySelectorAll']('.map-full');
        if (_0xa9b7x2d['length']) {
            var _0xa9b7x2e = document['querySelectorAll']('.show-map');
            var _0xa9b7x2f = document['querySelectorAll']('.hide-map');
            _0xa9b7x2e[0]['addEventListener']('click', function(_0xa9b7xb) {
                document['getElementsByClassName']('card-overlay')[0]['classList']['add']('disabled');
                document['getElementsByClassName']('card-center')[0]['classList']['add']('disabled');
                document['getElementsByClassName']('hide-map')[0]['classList']['remove']('disabled')
            });
            _0xa9b7x2f[0]['addEventListener']('click', function(_0xa9b7xb) {
                document['getElementsByClassName']('card-overlay')[0]['classList']['remove']('disabled');
                document['getElementsByClassName']('card-center')[0]['classList']['remove']('disabled');
                document['getElementsByClassName']('hide-map')[0]['classList']['add']('disabled')
            })
        };
        var _0xa9b7x30 = document['querySelectorAll']('.todo-list a');
        _0xa9b7x30['forEach']((_0xa9b7xc) => {
            return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                _0xa9b7xc['classList']['toggle']('opacity-50');
                _0xa9b7xc['querySelector']('i:last-child')['classList']['toggle']('far');
                _0xa9b7xc['querySelector']('i:last-child')['classList']['toggle']('fa');
                _0xa9b7xc['querySelector']('i:last-child')['classList']['toggle']('fa-check-square');
                _0xa9b7xc['querySelector']('i:last-child')['classList']['toggle']('fa-square');
                _0xa9b7xc['querySelector']('i:last-child')['classList']['toggle']('color-green-dark')
            })
        });
        var _0xa9b7x31 = document['querySelectorAll']('.menu');

        function _0xa9b7x32() {
            if (_0xa9b7x31['length']) {
                var _0xa9b7x33 = document['querySelectorAll']('.menu-box-left, .menu-box-right');
                _0xa9b7x33['forEach'](function(_0xa9b7xb) {
                    if (_0xa9b7xb['getAttribute']('data-menu-width') === 'cover') {
                        _0xa9b7xb['style']['width'] = '100%'
                    } else {
                        _0xa9b7xb['style']['width'] = (_0xa9b7xb['getAttribute']('data-menu-width')) + 'px'
                    }
                });
                var _0xa9b7x34 = document['querySelectorAll']('.menu-box-bottom, .menu-box-top, .menu-box-modal');
                _0xa9b7x34['forEach'](function(_0xa9b7xb) {
                    if (_0xa9b7xb['getAttribute']('data-menu-width') === 'cover') {
                        _0xa9b7xb['style']['width'] = '100%';
                        _0xa9b7xb['style']['height'] = '100%'
                    } else {
                        _0xa9b7xb['style']['width'] = (_0xa9b7xb['getAttribute']('data-menu-width')) + 'px';
                        _0xa9b7xb['style']['height'] = (_0xa9b7xb['getAttribute']('data-menu-height')) + 'px'
                    }
                });
                var _0xa9b7x35 = document['querySelectorAll']('[data-menu]');
                var _0xa9b7x36 = document['querySelectorAll']('.header, #footer-bar, .page-content');
                _0xa9b7x35['forEach']((_0xa9b7xc) => {
                    return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                        const _0xa9b7x37 = document['querySelectorAll']('.menu-active');
                        for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x37['length']; _0xa9b7xa++) {
                            _0xa9b7x37[_0xa9b7xa]['classList']['remove']('menu-active')
                        };
                        var _0xa9b7x38 = _0xa9b7xc['getAttribute']('data-menu');
                        document['getElementById'](_0xa9b7x38)['classList']['add']('menu-active');
                        document['getElementsByClassName']('menu-hider')[0]['classList']['add']('menu-active');
                        var _0xa9b7x39 = document['getElementById'](_0xa9b7x38);
                        var _0xa9b7x3a = _0xa9b7x39['getAttribute']('data-menu-effect');
                        var _0xa9b7x3b = _0xa9b7x39['classList']['contains']('menu-box-left');
                        var _0xa9b7x3c = _0xa9b7x39['classList']['contains']('menu-box-right');
                        var _0xa9b7x3d = _0xa9b7x39['classList']['contains']('menu-box-top');
                        var _0xa9b7x3e = _0xa9b7x39['classList']['contains']('menu-box-bottom');
                        var _0xa9b7x3f = _0xa9b7x39['offsetWidth'];
                        var _0xa9b7x40 = _0xa9b7x39['offsetHeight'];
                        if (_0xa9b7x3a === 'menu-push') {
                            var _0xa9b7x3f = document['getElementById'](_0xa9b7x38)['getAttribute']('data-menu-width');
                            if (_0xa9b7x3b) {
                                for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x36['length']; _0xa9b7xa++) {
                                    _0xa9b7x36[_0xa9b7xa]['style']['transform'] = 'translateX(' + _0xa9b7x3f + 'px)'
                                }
                            };
                            if (_0xa9b7x3c) {
                                for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x36['length']; _0xa9b7xa++) {
                                    _0xa9b7x36[_0xa9b7xa]['style']['transform'] = 'translateX(-' + _0xa9b7x3f + 'px)'
                                }
                            };
                            if (_0xa9b7x3e) {
                                for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x36['length']; _0xa9b7xa++) {
                                    _0xa9b7x36[_0xa9b7xa]['style']['transform'] = 'translateY(-' + _0xa9b7x40 + 'px)'
                                }
                            };
                            if (_0xa9b7x3d) {
                                for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x36['length']; _0xa9b7xa++) {
                                    _0xa9b7x36[_0xa9b7xa]['style']['transform'] = 'translateY(' + _0xa9b7x40 + 'px)'
                                }
                            }
                        };
                        if (_0xa9b7x3a === 'menu-parallax') {
                            var _0xa9b7x3f = document['getElementById'](_0xa9b7x38)['getAttribute']('data-menu-width');
                            if (_0xa9b7x3b) {
                                for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x36['length']; _0xa9b7xa++) {
                                    _0xa9b7x36[_0xa9b7xa]['style']['transform'] = 'translateX(' + _0xa9b7x3f / 10 + 'px)'
                                }
                            };
                            if (_0xa9b7x3c) {
                                for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x36['length']; _0xa9b7xa++) {
                                    _0xa9b7x36[_0xa9b7xa]['style']['transform'] = 'translateX(-' + _0xa9b7x3f / 10 + 'px)'
                                }
                            };
                            if (_0xa9b7x3e) {
                                for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x36['length']; _0xa9b7xa++) {
                                    _0xa9b7x36[_0xa9b7xa]['style']['transform'] = 'translateY(-' + _0xa9b7x40 / 5 + 'px)'
                                }
                            };
                            if (_0xa9b7x3d) {
                                for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x36['length']; _0xa9b7xa++) {
                                    _0xa9b7x36[_0xa9b7xa]['style']['transform'] = 'translateY(' + _0xa9b7x40 / 5 + 'px)'
                                }
                            }
                        }
                    })
                });
                const _0xa9b7x41 = document['querySelectorAll']('.close-menu, .menu-hider');
                _0xa9b7x41['forEach']((_0xa9b7xc) => {
                    return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                        const _0xa9b7x37 = document['querySelectorAll']('.menu-active');
                        for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x37['length']; _0xa9b7xa++) {
                            _0xa9b7x37[_0xa9b7xa]['classList']['remove']('menu-active')
                        };
                        for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x36['length']; _0xa9b7xa++) {
                            _0xa9b7x36[_0xa9b7xa]['style']['transform'] = 'translateX(-' + 0 + 'px)'
                        }
                    })
                })
            }
        }
        _0xa9b7x32();

        function _0xa9b7x42() {
            const _0xa9b7x43 = document['querySelectorAll']('[data-menu-active]')[0];
            if (_0xa9b7x43) {
                var _0xa9b7x44 = _0xa9b7x43['getAttribute']('data-menu-active');
                document['querySelectorAll']('#' + _0xa9b7x44)[0]['classList']['add']('active-nav');
                if (document['querySelectorAll']('#' + _0xa9b7x44)[0]['parentNode']['getAttribute']('class') === 'submenu') {
                    var _0xa9b7x45 = '#' + document['querySelectorAll']('#' + _0xa9b7x44)[0]['parentNode']['getAttribute']('id');
                    var _0xa9b7x46 = document['querySelectorAll']('#' + _0xa9b7x44)[0]['parentNode']['getAttribute']('id');
                    var _0xa9b7x47 = document['querySelectorAll'](_0xa9b7x45)[0]['children']['length'];
                    var _0xa9b7x48 = document['querySelectorAll'](_0xa9b7x45)[0]['offsetHeight'];
                    document['querySelectorAll'](_0xa9b7x45)[0]['style']['transition'] = 'all 250ms';
                    document['querySelectorAll'](_0xa9b7x45)[0]['style']['height'] = (_0xa9b7x47 * 50) + 26 + 'px';
                    document['querySelectorAll']('[data-submenu=\"' + _0xa9b7x46 + '\"]')[0]['classList']['add']('active-nav')
                }
            };
            document['querySelectorAll']('[data-submenu]')['forEach'](function(_0xa9b7xb) {
                var _0xa9b7x49 = _0xa9b7xb['getAttribute']('data-submenu');
                var _0xa9b7x4a = document['getElementById'](_0xa9b7x49)['children']['length'];
                var _0xa9b7x4b = _0xa9b7xb['querySelectorAll']('strong')[0];
                _0xa9b7x4b['insertAdjacentHTML']('beforeend', _0xa9b7x4a)
            });
            var _0xa9b7x4c = document['querySelectorAll']('[data-submenu]');
            _0xa9b7x4c['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                    _0xa9b7xc['classList']['toggle']('nav-item-active');
                    var _0xa9b7x46 = _0xa9b7xc['getAttribute']('data-submenu');
                    var _0xa9b7x45 = '#' + _0xa9b7x46;
                    var _0xa9b7x47 = document['querySelectorAll'](_0xa9b7x45)[0]['children']['length'];
                    var _0xa9b7x48 = document['querySelectorAll'](_0xa9b7x45)[0]['offsetHeight'];
                    if (_0xa9b7x48 === 0) {
                        document['querySelectorAll'](_0xa9b7x45)[0]['style']['transition'] = 'all 250ms';
                        document['querySelectorAll'](_0xa9b7x45)[0]['style']['height'] = (_0xa9b7x47 * 50) + 26 + 'px'
                    } else {
                        document['querySelectorAll'](_0xa9b7x45)[0]['style']['transition'] = 'all 250ms';
                        document['querySelectorAll'](_0xa9b7x45)[0]['style']['height'] = '0px'
                    }
                })
            })
        }
        const _0xa9b7x4d = document['querySelectorAll']('[data-back-button]');
        if (_0xa9b7x4d['length']) {
            _0xa9b7x4d['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                    _0xa9b7xb['stopPropagation'];
                    _0xa9b7xb['preventDefault'];
                    window['history']['go'](-1)
                })
            })
        };

        function _0xa9b7x4e() {
            const _0xa9b7x4f = document['querySelectorAll']('.back-to-top-icon, .back-to-top-badge, .back-to-top, [data-back-to-top]');
            if (_0xa9b7x4f) {
                _0xa9b7x4f['forEach']((_0xa9b7xc) => {
                    return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                        window['scrollTo']({
                            top: 0,
                            behavior: `${'smooth'}`
                        })
                    })
                })
            }
        }

        function _0xa9b7x50() {
            let _0xa9b7x51, _0xa9b7x52;
            if (/iP(hone|od|ad)/ ['test'](navigator['platform'])) {
                _0xa9b7x52 = (navigator['appVersion'])['match'](/OS (\d+)_(\d+)_?(\d+)?/);
                _0xa9b7x51 = {
                    status: true,
                    version: parseInt(_0xa9b7x52[1], 10),
                    info: parseInt(_0xa9b7x52[1], 10) + '.' + parseInt(_0xa9b7x52[2], 10) + '.' + parseInt(_0xa9b7x52[3] || 0, 10)
                }
            } else {
                _0xa9b7x51 = {
                    status: false,
                    version: false,
                    info: ''
                }
            };
            return _0xa9b7x51
        }
        let _0xa9b7x53 = _0xa9b7x50();
        if (_0xa9b7x53['version'] > 14) {
            document['querySelectorAll']('#page')[0]['classList']['add']('min-ios15')
        };
        const _0xa9b7x54 = document['getElementsByClassName']('card');

        function _0xa9b7x55() {
            var _0xa9b7x56, _0xa9b7x57, _0xa9b7x58;
            var _0xa9b7x58 = document['querySelectorAll']('.header:not(.header-transparent)')[0];
            var _0xa9b7x59 = document['querySelectorAll']('#footer-bar')[0];
            _0xa9b7x58 ? _0xa9b7x56 = document['querySelectorAll']('.header')[0]['offsetHeight'] : _0xa9b7x56 = 0;
            _0xa9b7x59 ? _0xa9b7x57 = document['querySelectorAll']('#footer-bar')[0]['offsetHeight'] : _0xa9b7x57 = 0;
            for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x54['length']; _0xa9b7xa++) {
                if (_0xa9b7x54[_0xa9b7xa]['getAttribute']('data-card-height') === 'cover') {
                    if (window['matchMedia']('(display-mode: fullscreen)')['matches']) {
                        var _0xa9b7x5a = window['outerHeight']
                    };
                    if (!window['matchMedia']('(display-mode: fullscreen)')['matches']) {
                        var _0xa9b7x5a = window['innerHeight']
                    };
                    var _0xa9b7x5b = _0xa9b7x5a + 'px'
                };
                if (_0xa9b7x54[_0xa9b7xa]['getAttribute']('data-card-height') === 'cover-boxed') {
                    if (window['matchMedia']('(display-mode: fullscreen)')['matches']) {
                        var _0xa9b7x5a = window['outerHeight']
                    };
                    if (!window['matchMedia']('(display-mode: fullscreen)')['matches']) {
                        var _0xa9b7x5a = window['innerHeight']
                    };
                    var _0xa9b7x5c = _0xa9b7x5a - _0xa9b7x56 - _0xa9b7x57 - 40 + 'px'
                };
                if (_0xa9b7x54[_0xa9b7xa]['hasAttribute']('data-card-height')) {
                    var _0xa9b7x5d = _0xa9b7x54[_0xa9b7xa]['getAttribute']('data-card-height');
                    _0xa9b7x54[_0xa9b7xa]['style']['height'] = _0xa9b7x5d + 'px';
                    if (_0xa9b7x5d === 'cover') {
                        var _0xa9b7x5e = _0xa9b7x5d;
                        _0xa9b7x54[_0xa9b7xa]['style']['height'] = _0xa9b7x5b
                    };
                    if (_0xa9b7x5d === 'cover-full') {
                        var _0xa9b7x5e = _0xa9b7x5d;
                        _0xa9b7x54[_0xa9b7xa]['style']['height'] = '100%'
                    };
                    if (_0xa9b7x5d === 'cover-boxed') {
                        var _0xa9b7x5e = _0xa9b7x5d;
                        _0xa9b7x54[_0xa9b7xa]['style']['height'] = _0xa9b7x5c
                    }
                }
            }
        }
        if (_0xa9b7x54['length']) {
            _0xa9b7x55();
            window['addEventListener']('resize', _0xa9b7x55)
        };

        function _0xa9b7x5f() {
            const _0xa9b7x60 = document['querySelectorAll']('[data-toggle-theme]');

            function _0xa9b7x61() {
                document['body']['classList']['add']('theme-dark');
                document['body']['classList']['remove']('theme-light', 'detect-theme');
                for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x60['length']; _0xa9b7xa++) {
                    _0xa9b7x60[_0xa9b7xa]['checked'] = 'checked'
                };
                localStorage['setItem'](_0xa9b7x4 + '-Theme', 'dark-mode')
            }

            function _0xa9b7x62() {
                document['body']['classList']['add']('theme-light');
                document['body']['classList']['remove']('theme-dark', 'detect-theme');
                for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x60['length']; _0xa9b7xa++) {
                    _0xa9b7x60[_0xa9b7xa]['checked'] = false
                };
                localStorage['setItem'](_0xa9b7x4 + '-Theme', 'light-mode')
            }

            function _0xa9b7x63() {
                var _0xa9b7x64 = document['querySelectorAll']('.btn, .header, #footer-bar, .menu-box, .menu-active');
                for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x64['length']; _0xa9b7xa++) {
                    _0xa9b7x64[_0xa9b7xa]['style']['transition'] = 'all 0s ease'
                }
            }

            function _0xa9b7x65() {
                var _0xa9b7x66 = document['querySelectorAll']('.btn, .header, #footer-bar, .menu-box, .menu-active');
                for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x66['length']; _0xa9b7xa++) {
                    _0xa9b7x66[_0xa9b7xa]['style']['transition'] = ''
                }
            }

            function _0xa9b7x67() {
                const _0xa9b7x68 = window['matchMedia']('(prefers-color-scheme: dark)')['matches'];
                const _0xa9b7x69 = window['matchMedia']('(prefers-color-scheme: light)')['matches'];
                const _0xa9b7x6a = window['matchMedia']('(prefers-color-scheme: no-preference)')['matches'];
                window['matchMedia']('(prefers-color-scheme: dark)')['addListener']((_0xa9b7xb) => {
                    return _0xa9b7xb['matches'] && _0xa9b7x61()
                });
                window['matchMedia']('(prefers-color-scheme: light)')['addListener']((_0xa9b7xb) => {
                    return _0xa9b7xb['matches'] && _0xa9b7x62()
                });
                if (_0xa9b7x68) {
                    _0xa9b7x61()
                };
                if (_0xa9b7x69) {
                    _0xa9b7x62()
                }
            }
            var _0xa9b7x6b = document['querySelectorAll']('[data-toggle-theme]');
            _0xa9b7x6b['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                    if (document['body']['className'] == 'theme-light') {
                        _0xa9b7x63();
                        _0xa9b7x61()
                    } else {
                        if (document['body']['className'] == 'theme-dark') {
                            _0xa9b7x63();
                            _0xa9b7x62()
                        }
                    };
                    setTimeout(function() {
                        _0xa9b7x65()
                    }, 350)
                })
            });
            if (localStorage['getItem'](_0xa9b7x4 + '-Theme') == 'dark-mode') {
                for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x60['length']; _0xa9b7xa++) {
                    _0xa9b7x60[_0xa9b7xa]['checked'] = 'checked'
                };
                document['body']['className'] = 'theme-dark'
            };
            if (localStorage['getItem'](_0xa9b7x4 + '-Theme') == 'light-mode') {
                document['body']['className'] = 'theme-light'
            };
            if (document['body']['className'] == 'detect-theme') {
                _0xa9b7x67()
            };
            const _0xa9b7x6c = document['querySelectorAll']('.detect-dark-mode');
            _0xa9b7x6c['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                    document['body']['classList']['remove']('theme-light', 'theme-dark');
                    document['body']['classList']['add']('detect-theme');
                    setTimeout(function() {
                        _0xa9b7x67()
                    }, 50)
                })
            })
        }
        if (localStorage['getItem'](_0xa9b7x4 + '-Theme') == 'dark-mode') {
            document['body']['className'] = 'theme-dark'
        };
        if (localStorage['getItem'](_0xa9b7x4 + '-Theme') == 'light-mode') {
            document['body']['className'] = 'theme-light'
        };
        const _0xa9b7x6c = document['querySelectorAll']('.detect-dark-mode');
        _0xa9b7x6c['forEach']((_0xa9b7xc) => {
            return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                document['body']['classList']['remove']('theme-light', 'theme-dark');
                document['body']['classList']['add']('detect-theme');
                setTimeout(function() {
                    setColorScheme()
                }, 50)
            })
        });
        if (localStorage['getItem'](_0xa9b7x4 + '-Gradient-Theme')) {
            var _0xa9b7x6d = localStorage['getItem'](_0xa9b7x4 + '-Gradient-Theme');
            document['body']['setAttribute']('data-gradient', _0xa9b7x6d)
        };

        function _0xa9b7x6e() {
            var _0xa9b7x6e = document['querySelectorAll']('[data-gradient-change]');
            if (_0xa9b7x6e) {
                _0xa9b7x6e['forEach']((_0xa9b7xc) => {
                    return _0xa9b7xc['addEventListener']('click', (_0xa9b7x6f) => {
                        var _0xa9b7x6d = _0xa9b7xc['getAttribute']('data-gradient-change');
                        localStorage['setItem'](_0xa9b7x4 + '-Gradient-Theme', _0xa9b7x6d);
                        document['body']['setAttribute']('data-gradient', _0xa9b7x6d)
                    })
                })
            }
        }
        const _0xa9b7x70 = document['querySelectorAll']('.accordion-btn');
        if (_0xa9b7x70['length']) {
            _0xa9b7x70['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('click', (_0xa9b7x6f) => {
                    _0xa9b7xc['querySelector']('i:last-child')['classList']['toggle']('fa-rotate-180')
                })
            })
        };
        const _0xa9b7x71 = document['getElementsByClassName']('upload-file');
        if (_0xa9b7x71['length']) {
            _0xa9b7x71[0]['addEventListener']('change', _0xa9b7x72, false);

            function _0xa9b7x72(_0xa9b7x6f) {
                if (this['files'] && this['files'][0]) {
                    var _0xa9b7x73 = document['getElementById']('image-data');
                    _0xa9b7x73['src'] = URL['createObjectURL'](this['files'][0])
                };
                const _0xa9b7x74 = _0xa9b7x6f['target']['files'];
                const _0xa9b7x75 = _0xa9b7x74[0]['name'];
                document['getElementsByClassName']('file-data')[0]['classList']['add']('disabled');
                document['getElementsByClassName']('upload-file-data')[0]['classList']['remove']('disabled');
                document['getElementsByClassName']('upload-file-name')[0]['innerHTML'] = _0xa9b7x74[0]['name'];
                document['getElementsByClassName']('upload-file-modified')[0]['innerHTML'] = _0xa9b7x74[0]['lastModifiedDate'];
                document['getElementsByClassName']('upload-file-size')[0]['innerHTML'] = _0xa9b7x74[0]['size'] / 1000 + 'kb';
                document['getElementsByClassName']('upload-file-type')[0]['innerHTML'] = _0xa9b7x74[0]['type']
            }
        };
        var _0xa9b7x76 = document['querySelectorAll']('.get-location');
        if (_0xa9b7x76['length']) {
            var _0xa9b7x77 = document['getElementsByClassName']('location-support')[0];
            if (typeof(_0xa9b7x77) != 'undefined' && _0xa9b7x77 != null) {
                if ('geolocation' in navigator) {
                    _0xa9b7x77['innerHTML'] = 'Your browser and device <strong class=\"color-green2-dark\">support</strong> Geolocation.'
                } else {
                    _0xa9b7x77['innerHTML'] = 'Your browser and device <strong class=\"color-red2-dark\">support</strong> Geolocation.'
                }
            };

            function _0xa9b7x78() {
                const _0xa9b7x79 = document['querySelector']('.location-coordinates');

                function _0xa9b7x7a(_0xa9b7x7b) {
                    const _0xa9b7x7c = _0xa9b7x7b['coords']['latitude'];
                    const _0xa9b7x7d = _0xa9b7x7b['coords']['longitude'];
                    _0xa9b7x79['innerHTML'] = '<strong>Longitude:</strong> ' + _0xa9b7x7d + '<br><strong>Latitude:</strong> ' + _0xa9b7x7c;
                    var _0xa9b7x7e = 'https://www.google.com/maps/embed/v1/view?key=AIzaSyAM3nxDVrkjyKwdIZp8QOplmBKLRVI5S_Y&center=';
                    var _0xa9b7x7f = _0xa9b7x7c + ',';
                    var _0xa9b7x80 = _0xa9b7x7d;
                    var _0xa9b7x81 = '&zoom=16&maptype=satellite';
                    var _0xa9b7x82 = '';
                    var _0xa9b7x83 = _0xa9b7x7e + _0xa9b7x7f + _0xa9b7x80 + _0xa9b7x81;
                    var _0xa9b7x84 = _0xa9b7x7e + _0xa9b7x7f + _0xa9b7x80 + _0xa9b7x82;
                    document['getElementsByClassName']('location-map')[0]['setAttribute']('src', _0xa9b7x83);
                    document['getElementsByClassName']('location-button')[0]['setAttribute']('href', _0xa9b7x84);
                    document['getElementsByClassName']('location-button')[0]['classList']['remove']('disabled')
                }

                function _0xa9b7x85() {
                    _0xa9b7x79['textContent'] = 'Unable to retrieve your location'
                }
                if (!navigator['geolocation']) {
                    _0xa9b7x79['textContent'] = 'Geolocation is not supported by your browser'
                } else {
                    _0xa9b7x79['textContent'] = 'Locating';
                    navigator['geolocation']['getCurrentPosition'](_0xa9b7x7a, _0xa9b7x85)
                }
            }
            var _0xa9b7x86 = document['getElementsByClassName']('get-location')[0];
            if (typeof(_0xa9b7x86) != 'undefined' && _0xa9b7x86 != null) {
                _0xa9b7x86['addEventListener']('click', function() {
                    this['classList']['add']('disabled');
                    _0xa9b7x78()
                })
            }
        };
        const _0xa9b7x87 = document['querySelectorAll']('.card-scale');
        if (_0xa9b7x87['length']) {
            _0xa9b7x87['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('mouseenter', (_0xa9b7x6f) => {
                    _0xa9b7xc['querySelectorAll']('img')[0]['classList']['add']('card-scale-image')
                })
            });
            _0xa9b7x87['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('mouseleave', (_0xa9b7x6f) => {
                    _0xa9b7xc['querySelectorAll']('img')[0]['classList']['remove']('card-scale-image')
                })
            })
        };
        const _0xa9b7x88 = document['querySelectorAll']('.card-hide');
        if (_0xa9b7x88['length']) {
            _0xa9b7x88['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('mouseenter', (_0xa9b7x6f) => {
                    _0xa9b7xc['querySelectorAll']('.card-center, .card-bottom, .card-top, .card-overlay')[0]['classList']['add']('card-hide-image')
                })
            });
            _0xa9b7x88['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('mouseleave', (_0xa9b7x6f) => {
                    _0xa9b7xc['querySelectorAll']('.card-center, .card-bottom, .card-top, .card-overlay')[0]['classList']['remove']('card-hide-image')
                })
            })
        };
        const _0xa9b7x89 = document['querySelectorAll']('.card-rotate');
        if (_0xa9b7x89['length']) {
            _0xa9b7x89['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('mouseenter', (_0xa9b7x6f) => {
                    _0xa9b7xc['querySelectorAll']('img')[0]['classList']['add']('card-rotate-image')
                })
            });
            _0xa9b7x89['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('mouseleave', (_0xa9b7x6f) => {
                    _0xa9b7xc['querySelectorAll']('img')[0]['classList']['remove']('card-rotate-image')
                })
            })
        };
        const _0xa9b7x8a = document['querySelectorAll']('.card-grayscale');
        if (_0xa9b7x8a['length']) {
            _0xa9b7x8a['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('mouseenter', (_0xa9b7x6f) => {
                    _0xa9b7xc['querySelectorAll']('img')[0]['classList']['add']('card-grayscale-image')
                })
            });
            _0xa9b7x8a['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('mouseleave', (_0xa9b7x6f) => {
                    _0xa9b7xc['querySelectorAll']('img')[0]['classList']['remove']('card-grayscale-image')
                })
            })
        };
        const _0xa9b7x8b = document['querySelectorAll']('.card-blur');
        if (_0xa9b7x8b['length']) {
            _0xa9b7x8b['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('mouseenter', (_0xa9b7x6f) => {
                    _0xa9b7xc['querySelectorAll']('img')[0]['classList']['add']('card-blur-image')
                })
            });
            _0xa9b7x8b['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('mouseleave', (_0xa9b7x6f) => {
                    _0xa9b7xc['querySelectorAll']('img')[0]['classList']['remove']('card-blur-image')
                })
            })
        };
        var _0xa9b7x8c = document['querySelectorAll']('.check-visited');
        if (_0xa9b7x8c['length']) {
            function _0xa9b7x8d() {
                var _0xa9b7x8e = JSON['parse'](localStorage['getItem'](_0xa9b7x4 + '_Visited_Links')) || [];
                var _0xa9b7x8f = document['querySelectorAll']('.check-visited a');
                for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x8f['length']; _0xa9b7xa++) {
                    var _0xa9b7x90 = _0xa9b7x8f[_0xa9b7xa];
                    _0xa9b7x90['addEventListener']('click', function(_0xa9b7xb) {
                        var _0xa9b7x91 = this['href'];
                        if (_0xa9b7x8e['indexOf'](_0xa9b7x91) == -1) {
                            _0xa9b7x8e['push'](_0xa9b7x91);
                            localStorage['setItem'](_0xa9b7x4 + '_Visited_Links', JSON['stringify'](_0xa9b7x8e))
                        }
                    });
                    if (_0xa9b7x8e['indexOf'](_0xa9b7x90['href']) !== -1) {
                        _0xa9b7x90['className'] += ' visited-link'
                    }
                }
            }
            _0xa9b7x8d()
        };
        var _0xa9b7x92 = document['getElementById']('adblock-message');
        if (_0xa9b7x92) {
            var _0xa9b7x93 = false;
            document['body']['innerHTML'] += '<div class=\"adsbygoogle\" id=\"ad-detector\"></div>';
            var _0xa9b7x94 = document['getElementById']('ad-detector');
            var _0xa9b7x95 = getComputedStyle(_0xa9b7x94, null);
            if (_0xa9b7x95['display'] === 'none') {
                document['getElementById']('adblock-message')['classList']['remove']('disabled')
            }
        };
        let _0xa9b7x96 = document['querySelectorAll']('.fixed-ad')[0];
        let _0xa9b7x97 = document['querySelectorAll']('.scroll-ad')[0];
        if (_0xa9b7x96 || _0xa9b7x97) {
            var _0xa9b7x98 = document['getElementById']('activate-scroll-ad');
            _0xa9b7x98['addEventListener']('click', function() {
                _0xa9b7x97['classList']['add']('scroll-ad-visible');
                _0xa9b7x97['classList']['remove']('disabled');
                _0xa9b7x96['classList']['add']('disabled')
            });
            var _0xa9b7x99 = document['getElementById']('activate-fixed-ad');
            _0xa9b7x99['addEventListener']('click', function() {
                _0xa9b7x97['classList']['add']('disabled');
                _0xa9b7x96['classList']['remove']('disabled')
            })
        };
        var _0xa9b7x9a = document['querySelectorAll']('.scroll-ad, .header-auto-show');
        if (_0xa9b7x9a['length']) {
            var _0xa9b7x9b = document['querySelectorAll']('.scroll-ad');
            var _0xa9b7x9c = document['querySelectorAll']('.header-auto-show');
            window['addEventListener']('scroll', function() {
                if (document['querySelectorAll']('.scroll-ad, .header-auto-show')['length']) {
                    function _0xa9b7x9d() {
                        _0xa9b7x9b[0]['classList']['add']('scroll-ad-visible')
                    }

                    function _0xa9b7x9e() {
                        _0xa9b7x9b[0]['classList']['remove']('scroll-ad-visible')
                    }

                    function _0xa9b7x9f() {
                        _0xa9b7x9c[0]['classList']['add']('header-active')
                    }

                    function _0xa9b7xa0() {
                        _0xa9b7x9c[0]['classList']['remove']('header-active')
                    }
                    var _0xa9b7xa1 = window['outerWidth'];
                    var _0xa9b7xa2 = document['documentElement']['scrollTop'];
                    let _0xa9b7xa3 = _0xa9b7xa2 <= 150;
                    var _0xa9b7xa4 = _0xa9b7xa2 >= 150;
                    let _0xa9b7xa5 = (_0xa9b7xa1 - _0xa9b7xa2 + 1000) <= 150;
                    if (_0xa9b7x9b['length']) {
                        _0xa9b7xa3 ? _0xa9b7x9e() : null;
                        _0xa9b7xa4 ? _0xa9b7x9d() : null;
                        _0xa9b7xa5 ? _0xa9b7x9e() : null
                    };
                    if (_0xa9b7x9c['length']) {
                        _0xa9b7xa3 ? _0xa9b7xa0() : null;
                        _0xa9b7xa4 ? _0xa9b7x9f() : null
                    }
                }
            })
        };
        var _0xa9b7xa6 = document['querySelectorAll']('.stepper-add');
        var _0xa9b7xa7 = document['querySelectorAll']('.stepper-sub');
        if (_0xa9b7xa6['length']) {
            _0xa9b7xa6['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('click', (_0xa9b7x6f) => {
                    var _0xa9b7xa8 = _0xa9b7xc['parentElement']['querySelector']('input')['value'];
                    _0xa9b7xc['parentElement']['querySelector']('input')['value'] = +_0xa9b7xa8 + 1
                })
            });
            _0xa9b7xa7['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('click', (_0xa9b7x6f) => {
                    var _0xa9b7xa8 = _0xa9b7xc['parentElement']['querySelector']('input')['value'];
                    _0xa9b7xc['parentElement']['querySelector']('input')['value'] = +_0xa9b7xa8 - 1
                })
            })
        };
        var _0xa9b7xa9 = document['querySelectorAll']('[data-trigger-switch]:not([data-toggle-theme])');
        if (_0xa9b7xa9['length']) {
            _0xa9b7xa9['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('click', (_0xa9b7x6f) => {
                    var _0xa9b7xaa = _0xa9b7xc['getAttribute']('data-trigger-switch');
                    var _0xa9b7xab = document['getElementById'](_0xa9b7xaa);
                    _0xa9b7xab['checked'] ? _0xa9b7xab['checked'] = false : _0xa9b7xab['checked'] = true
                })
            })
        };
        var _0xa9b7xac = document['querySelectorAll']('.classic-toggle');
        if (_0xa9b7xac['length']) {
            _0xa9b7xac['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('click', (_0xa9b7x6f) => {
                    _0xa9b7xc['querySelector']('i:last-child')['classList']['toggle']('fa-rotate-180');
                    _0xa9b7xc['querySelector']('i:last-child')['style']['transition'] = 'all 250ms ease'
                })
            })
        };
        var _0xa9b7xad = document['querySelectorAll']('[data-toast]');
        if (_0xa9b7xad['length']) {
            _0xa9b7xad['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('click', (_0xa9b7x6f) => {
                    var _0xa9b7xae = _0xa9b7xc['getAttribute']('data-toast');
                    var _0xa9b7xaf = document['getElementById'](_0xa9b7xae);
                    var _0xa9b7xaf = new bootstrap.Toast(_0xa9b7xaf);
                    _0xa9b7xaf['show']()
                })
            })
        };
        var _0xa9b7xb0 = []['slice']['call'](document['querySelectorAll']('[data-bs-toggle=\"dropdown\"]'));
        if (_0xa9b7xb0['length']) {
            var _0xa9b7xb1 = _0xa9b7xb0['map'](function(_0xa9b7xb2) {
                return new bootstrap.Dropdown(_0xa9b7xb2)
            })
        };
        var _0xa9b7xb3 = document['querySelectorAll']('.show-business-opened, .show-business-closed, .working-hours');
        if (_0xa9b7xb3['length']) {
            var _0xa9b7x51 = new Date();
            var _0xa9b7xb4 = _0xa9b7x51['getDay']();
            var _0xa9b7xb5 = _0xa9b7x51['getHours']() + '.' + _0xa9b7x51['getMinutes']();
            var _0xa9b7xb6 = [
                ['Sunday'],
                ['Monday', 9.00, 17.00],
                ['Tuesday', 9.00, 17.00],
                ['Wednesday', 9.00, 17.00],
                ['Thursday', 9.00, 17.00],
                ['Friday', 9.00, 17.00],
                ['Saturday', 9.00, 13.00]
            ];
            var _0xa9b7xb7 = _0xa9b7xb6[_0xa9b7xb4];
            var _0xa9b7xb8 = document['querySelectorAll']('.show-business-opened');
            var _0xa9b7xb9 = document['querySelectorAll']('.show-business-closed');
            if (_0xa9b7xb5 > _0xa9b7xb7[1] && _0xa9b7xb5 < _0xa9b7xb7[2] || _0xa9b7xb5 > _0xa9b7xb7[3] && _0xa9b7xb5 < _0xa9b7xb7[4]) {
                _0xa9b7xb8['forEach'](function(_0xa9b7xb) {
                    _0xa9b7xb['classList']['remove']('disabled')
                });
                _0xa9b7xb9['forEach'](function(_0xa9b7xb) {
                    _0xa9b7xb['classList']['add']('disabled')
                })
            } else {
                _0xa9b7xb8['forEach'](function(_0xa9b7xb) {
                    _0xa9b7xb['classList']['add']('disabled')
                });
                _0xa9b7xb9['forEach'](function(_0xa9b7xb) {
                    _0xa9b7xb['classList']['remove']('disabled')
                })
            };
            var _0xa9b7xb3 = document['querySelectorAll']('.working-hours[data-day]');
            _0xa9b7xb3['forEach'](function(_0xa9b7xba) {
                var _0xa9b7xbb = _0xa9b7xba['getAttribute']('data-day');
                if (_0xa9b7xbb === _0xa9b7xb7[0]) {
                    var _0xa9b7xbc = '[data-day=\"' + _0xa9b7xb7[0] + '\"]';
                    if (_0xa9b7xb5 > _0xa9b7xb7[1] && _0xa9b7xb5 < _0xa9b7xb7[2] || _0xa9b7xb5 > _0xa9b7xb7[3] && _0xa9b7xb5 < _0xa9b7xb7[4]) {
                        document['querySelectorAll'](_0xa9b7xbc)[0]['classList']['add']('bg-green-dark');
                        document['querySelectorAll'](_0xa9b7xbc + ' p')['forEach'](function(_0xa9b7xbd) {
                            _0xa9b7xbd['classList']['add']('color-white')
                        })
                    } else {
                        document['querySelectorAll'](_0xa9b7xbc)[0]['classList']['add']('bg-red-dark');
                        document['querySelectorAll'](_0xa9b7xbc + ' p')['forEach'](function(_0xa9b7xbd) {
                            _0xa9b7xbd['classList']['add']('color-white')
                        })
                    }
                }
            })
        };
        var _0xa9b7xbe = document['querySelectorAll']('[data-vibrate]');
        if (_0xa9b7xbe['length']) {
            var _0xa9b7xbf = document['getElementsByClassName']('start-vibrating')[0];
            var _0xa9b7xc0 = document['getElementsByClassName']('stop-vibrating')[0];
            _0xa9b7xbf['addEventListener']('click', function() {
                var _0xa9b7xc1 = document['getElementsByClassName']('vibrate-demo')[0]['value'];
                window['navigator']['vibrate'](_0xa9b7xc1)
            });
            _0xa9b7xc0['addEventListener']('click', function() {
                window['navigator']['vibrate'](0)
            });
            _0xa9b7xbe['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                    var _0xa9b7xc1 = _0xa9b7xc['getAttribute']('data-vibrate');
                    window['navigator']['vibrate'](_0xa9b7xc1)
                })
            })
        };
        var _0xa9b7xc2 = document['querySelectorAll']('[data-timed-ad]');
        if (_0xa9b7xc2['length']) {
            _0xa9b7xc2['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                    var _0xa9b7xc3 = _0xa9b7xc['getAttribute']('data-timed-ad');
                    var _0xa9b7xc4 = _0xa9b7xc['getAttribute']('data-menu');
                    var _0xa9b7xc5 = _0xa9b7xc3;
                    var _0xa9b7xc6 = setInterval(function() {
                        if (_0xa9b7xc5 <= 1) {
                            clearInterval(_0xa9b7xc6);
                            document['getElementById'](_0xa9b7xc4)['querySelectorAll']('.fa-times')[0]['classList']['remove']('disabled');
                            document['getElementById'](_0xa9b7xc4)['querySelectorAll']('.close-menu')[0]['classList']['remove']('no-click');
                            document['getElementById'](_0xa9b7xc4)['querySelectorAll']('span')[0]['style']['display'] = 'none'
                        } else {};
                        document['getElementById'](_0xa9b7xc4)['querySelectorAll']('span')[0]['innerHTML'] = _0xa9b7xc5 -= 1
                    }, 1000)
                })
            })
        };
        var _0xa9b7xc7 = document['querySelectorAll']('[data-auto-show-ad]');
        if (_0xa9b7xc7['length']) {
            var _0xa9b7xc8 = _0xa9b7xc7[0]['getAttribute']('data-auto-show-ad');
            var _0xa9b7xc6 = setInterval(function() {
                if (_0xa9b7xc8 <= 1) {
                    clearInterval(_0xa9b7xc6);
                    var _0xa9b7xc9 = _0xa9b7xc7[0]['getAttribute']('data-menu');
                    document['getElementById'](_0xa9b7xc9)['classList']['add']('menu-active');
                    var _0xa9b7xca = _0xa9b7xc7[0]['getAttribute']('data-timed-ad');
                    var _0xa9b7xcb = setInterval(function() {
                        if (_0xa9b7xca <= 0) {
                            clearInterval(_0xa9b7xcb);
                            document['getElementById'](_0xa9b7xc9)['querySelectorAll']('.fa-times')[0]['classList']['remove']('disabled');
                            document['getElementById'](_0xa9b7xc9)['querySelectorAll']('.close-menu')[0]['classList']['remove']('no-click');
                            document['getElementById'](_0xa9b7xc9)['querySelectorAll']('span')[0]['style']['display'] = 'none'
                        };
                        document['getElementById'](_0xa9b7xc9)['querySelectorAll']('span')[0]['innerHTML'] = _0xa9b7xca -= 1
                    }, 1000)
                };
                _0xa9b7xc8 -= 1
            }, 1000)
        };
        var _0xa9b7xcc = document['querySelectorAll']('.reading-progress-text');
        if (_0xa9b7xcc['length']) {
            var _0xa9b7xcd = _0xa9b7xcc[0]['innerHTML']['split'](' ')['length'];
            var _0xa9b7xce = Math['floor'](_0xa9b7xcd / 250);
            var _0xa9b7xcf = _0xa9b7xcd % 60;
            document['getElementsByClassName']('reading-progress-words')[0]['innerHTML'] = _0xa9b7xcd;
            document['getElementsByClassName']('reading-progress-time')[0]['innerHTML'] = _0xa9b7xce + ':' + _0xa9b7xcf
        };
        var _0xa9b7xd0 = document['querySelectorAll']('.text-size-changer');
        if (_0xa9b7xd0['length']) {
            var _0xa9b7xd1 = document['querySelectorAll']('.text-size-increase');
            var _0xa9b7xd2 = document['querySelectorAll']('.text-size-decrease');
            var _0xa9b7xd3 = document['querySelectorAll']('.text-size-default');
            _0xa9b7xd1[0]['addEventListener']('click', function() {
                _0xa9b7xd0[0]['querySelectorAll']('*')['forEach'](function(_0xa9b7xd4) {
                    const _0xa9b7xd5 = window['getComputedStyle'](_0xa9b7xd4)['fontSize']['split']('px', 2)[0];
                    _0xa9b7xd4['style']['fontSize'] = (+_0xa9b7xd5 + 1) + 'px'
                })
            });
            _0xa9b7xd2[0]['addEventListener']('click', function() {
                _0xa9b7xd0[0]['querySelectorAll']('*')['forEach'](function(_0xa9b7xd4) {
                    const _0xa9b7xd5 = window['getComputedStyle'](_0xa9b7xd4)['fontSize']['split']('px', 2)[0];
                    _0xa9b7xd4['style']['fontSize'] = (+_0xa9b7xd5 - 1) + 'px'
                })
            });
            _0xa9b7xd3[0]['addEventListener']('click', function() {
                _0xa9b7xd0[0]['querySelectorAll']('*')['forEach'](function(_0xa9b7xd4) {
                    const _0xa9b7xd5 = window['getComputedStyle'](_0xa9b7xd4)['fontSize']['split']('px', 2)[0];
                    _0xa9b7xd4['style']['fontSize'] = ''
                })
            })
        };
        var _0xa9b7xd6 = document['querySelectorAll']('.qr-image');
        if (_0xa9b7xd6['length']) {
            var _0xa9b7xd7 = window['location']['href'];
            var _0xa9b7xd8 = document['getElementsByClassName']('generate-qr-auto')[0];
            var _0xa9b7xd9 = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=';
            if (_0xa9b7xd8) {
                _0xa9b7xd8['setAttribute']('src', _0xa9b7xd9 + _0xa9b7xd7)
            };
            var _0xa9b7xda = document['getElementsByClassName']('generate-qr-button')[0];
            if (_0xa9b7xda) {
                _0xa9b7xda['addEventListener']('click', function() {
                    var _0xa9b7xdb = document['getElementsByClassName']('qr-url')[0]['value'];
                    var _0xa9b7xd9 = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=';
                    var _0xa9b7xdc = '<img class=\"mx-auto polaroid-effect shadow-l mt-4 delete-qr\" width=\"200\" src=\"' + _0xa9b7xd9 + _0xa9b7xdb + '\" alt=\"img\"><p class=\"font-11 text-center mb-0\">' + _0xa9b7xdb + '</p>';
                    document['getElementsByClassName']('generate-qr-result')[0]['innerHTML'] = _0xa9b7xdc;
                    _0xa9b7xda['innerHTML'] = 'Generate New Button'
                })
            }
        };
        if (window['location']['protocol'] === 'file:') {
            var _0xa9b7xdd = document['querySelectorAll']('a');
            _0xa9b7xdd['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('mouseover', (_0xa9b7x6f) => {})
            })
        };
        var _0xa9b7xde = document['querySelectorAll']('[data-search]');
        if (_0xa9b7xde['length']) {
            var _0xa9b7xdf = document['querySelectorAll']('.search-results');
            var _0xa9b7xe0 = document['querySelectorAll']('.search-no-results');
            var _0xa9b7xe1 = document['querySelectorAll']('.search-results div')[0]['childElementCount'];
            var _0xa9b7xe2 = document['querySelectorAll']('.search-trending');

            function _0xa9b7xe3() {
                var _0xa9b7xe4 = _0xa9b7xde[0]['value'];
                var _0xa9b7xe5 = _0xa9b7xe4['toLowerCase']();
                if (_0xa9b7xe5 != '') {
                    _0xa9b7xdf[0]['classList']['remove']('disabled-search-list');
                    var _0xa9b7xe6 = document['querySelectorAll']('[data-filter-item]');
                    for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7xe6['length']; _0xa9b7xa++) {
                        var _0xa9b7xe7 = _0xa9b7xe6[_0xa9b7xa]['getAttribute']('data-filter-name');
                        if (_0xa9b7xe7['includes'](_0xa9b7xe5)) {
                            _0xa9b7xe6[_0xa9b7xa]['classList']['remove']('disabled');
                            if (_0xa9b7xe2['length']) {
                                _0xa9b7xe2[0]['classList']['add']('disabled')
                            }
                        } else {
                            _0xa9b7xe6[_0xa9b7xa]['classList']['add']('disabled');
                            if (_0xa9b7xe2['length']) {
                                _0xa9b7xe2[0]['classList']['remove']('disabled')
                            }
                        };
                        var _0xa9b7xe8 = document['querySelectorAll']('.search-results div')[0]['getElementsByClassName']('disabled')['length'];
                        if (_0xa9b7xe8 === _0xa9b7xe1) {
                            _0xa9b7xe0[0]['classList']['remove']('disabled');
                            if (_0xa9b7xe2['length']) {
                                _0xa9b7xe2[0]['classList']['add']('disabled')
                            }
                        } else {
                            _0xa9b7xe0[0]['classList']['add']('disabled');
                            if (_0xa9b7xe2['length']) {
                                _0xa9b7xe2[0]['classList']['add']('disabled')
                            }
                        }
                    }
                };
                if (_0xa9b7xe5 === '') {
                    _0xa9b7xdf[0]['classList']['add']('disabled-search-list');
                    _0xa9b7xe0[0]['classList']['add']('disabled');
                    if (_0xa9b7xe2['length']) {
                        _0xa9b7xe2[0]['classList']['remove']('disabled')
                    }
                }
            }
            _0xa9b7xde[0]['addEventListener']('keyup', function() {
                _0xa9b7xe3()
            });
            _0xa9b7xde[0]['addEventListener']('click', function() {
                _0xa9b7xe3()
            });
            var _0xa9b7xe9 = document['querySelectorAll']('.search-trending a');
            _0xa9b7xe9['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('click', (_0xa9b7x6f) => {
                    var _0xa9b7xea = _0xa9b7xc['querySelectorAll']('span')[0]['textContent']['toLowerCase']();
                    _0xa9b7xde[0]['value'] = _0xa9b7xea;
                    _0xa9b7xde[0]['click']()
                })
            })
        };

        function _0xa9b7xeb() {
            var _0xa9b7xec = document['querySelectorAll']('.shareToFacebook, .shareToTwitter, .shareToLinkedIn');
            if (_0xa9b7xec['length']) {
                var _0xa9b7xed = window['location']['href'];
                var _0xa9b7xee = document['title'];
                document['querySelectorAll']('.shareToFacebook')['forEach']((_0xa9b7xef) => {
                    return _0xa9b7xef['setAttribute']('href', 'https://www.facebook.com/sharer/sharer.php?u=' + _0xa9b7xed)
                });
                document['querySelectorAll']('.shareToTwitter')['forEach']((_0xa9b7xef) => {
                    return _0xa9b7xef['setAttribute']('href', 'https://twitter.com/share?text=' + _0xa9b7xed)
                });
                document['querySelectorAll']('.shareToPinterest')['forEach']((_0xa9b7xef) => {
                    return _0xa9b7xef['setAttribute']('href', 'https://pinterest.com/pin/create/button/?url=' + _0xa9b7xed)
                });
                document['querySelectorAll']('.shareToWhatsApp')['forEach']((_0xa9b7xef) => {
                    return _0xa9b7xef['setAttribute']('href', 'whatsapp://send?text=' + _0xa9b7xed)
                });
                document['querySelectorAll']('.shareToMail')['forEach']((_0xa9b7xef) => {
                    return _0xa9b7xef['setAttribute']('href', 'mailto:?body=' + _0xa9b7xed)
                });
                document['querySelectorAll']('.shareToLinkedIn')['forEach']((_0xa9b7xef) => {
                    return _0xa9b7xef['setAttribute']('href', 'https://www.linkedin.com/shareArticle?mini=true&url=' + _0xa9b7xed + '&title=' + _0xa9b7xee + '&summary=&source=')
                })
            }
        }
        var _0xa9b7xf0 = document['querySelectorAll']('.contact-form');

        function _0xa9b7xf1() {
            if (_0xa9b7xf0) {
                var _0xa9b7xf2 = document['getElementById']('contactForm');
                if (_0xa9b7xf2) {
                    _0xa9b7xf2['onsubmit'] = function(_0xa9b7xb) {
                        _0xa9b7xb['preventDefault']();
                        var _0xa9b7xf3 = document['getElementById']('contactNameField');
                        var _0xa9b7xf4 = document['getElementById']('contactEmailField');
                        var _0xa9b7xf5 = document['getElementById']('contactMessageTextarea');
                        var _0xa9b7xf6 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                        if (_0xa9b7xf3['value'] === '') {
                            _0xa9b7xf2['setAttribute']('data-form', 'invalid');
                            _0xa9b7xf3['classList']['add']('border-red-dark');
                            document['getElementById']('validator-name')['classList']['remove']('disabled')
                        } else {
                            _0xa9b7xf2['setAttribute']('data-form', 'valid');
                            document['getElementById']('validator-name')['classList']['add']('disabled');
                            _0xa9b7xf3['classList']['remove']('border-red-dark')
                        };
                        if (_0xa9b7xf4['value'] === '') {
                            _0xa9b7xf2['setAttribute']('data-form', 'invalid');
                            _0xa9b7xf4['classList']['add']('border-red-dark');
                            document['getElementById']('validator-mail1')['classList']['remove']('disabled')
                        } else {
                            document['getElementById']('validator-mail1')['classList']['add']('disabled');
                            if (!_0xa9b7xf6['test'](_0xa9b7xf4['value'])) {
                                _0xa9b7xf2['setAttribute']('data-form', 'invalid');
                                _0xa9b7xf4['classList']['add']('border-red-dark');
                                document['getElementById']('validator-mail2')['classList']['remove']('disabled')
                            } else {
                                _0xa9b7xf2['setAttribute']('data-form', 'valid');
                                document['getElementById']('validator-mail2')['classList']['add']('disabled');
                                _0xa9b7xf4['classList']['remove']('border-red-dark')
                            }
                        };
                        if (_0xa9b7xf5['value'] === '') {
                            _0xa9b7xf2['setAttribute']('data-form', 'invalid');
                            _0xa9b7xf5['classList']['add']('border-red-dark');
                            document['getElementById']('validator-text')['classList']['remove']('disabled')
                        } else {
                            _0xa9b7xf2['setAttribute']('data-form', 'valid');
                            document['getElementById']('validator-text')['classList']['add']('disabled');
                            _0xa9b7xf5['classList']['remove']('border-red-dark')
                        };
                        if (_0xa9b7xf2['getAttribute']('data-form') === 'valid') {
                            document['querySelectorAll']('.form-sent')[0]['classList']['remove']('disabled');
                            document['querySelectorAll']('.contact-form')[0]['classList']['add']('disabled');
                            var _0xa9b7xf7 = {};
                            for (let _0xa9b7xa = 0, _0xa9b7xf8 = _0xa9b7xf2['length']; _0xa9b7xa < _0xa9b7xf8; ++_0xa9b7xa) {
                                let _0xa9b7xf9 = _0xa9b7xf2[_0xa9b7xa];
                                if (_0xa9b7xf9['name']) {
                                    _0xa9b7xf7[_0xa9b7xf9['name']] = _0xa9b7xf9['value']
                                }
                            };
                            var _0xa9b7xfa = new XMLHttpRequest();
                            _0xa9b7xfa['open'](_0xa9b7xf2['method'], _0xa9b7xf2['action'], true);
                            _0xa9b7xfa['setRequestHeader']('Accept', 'application/json; charset=utf-8');
                            _0xa9b7xfa['setRequestHeader']('Content-Type', 'application/json; charset=UTF-8');
                            _0xa9b7xfa['send'](JSON['stringify'](_0xa9b7xf7));
                            _0xa9b7xfa['onloadend'] = function(_0xa9b7xfb) {
                                if (_0xa9b7xfb['target']['status'] === 200) {
                                    console['log']('Form Submitted')
                                }
                            }
                        }
                    }
                }
            }
        }
        var _0xa9b7xfc = document['querySelectorAll']('[data-bs-toggle=\"collapse\"]:not(.no-effect)');
        if (_0xa9b7xfc['length']) {
            _0xa9b7xfc['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                    if (_0xa9b7xc['querySelectorAll']('i')['length']) {
                        _0xa9b7xc['querySelector']('i')['classList']['toggle']('fa-rotate-180')
                    }
                })
            })
        };
        var _0xa9b7xfd = document['querySelectorAll']('.tab-controls a');
        if (_0xa9b7xfd['length']) {
            _0xa9b7xfd['forEach'](function(_0xa9b7xb) {
                if (_0xa9b7xb['hasAttribute']('data-active')) {
                    var _0xa9b7xfe = _0xa9b7xb['parentNode']['getAttribute']('data-highlight');
                    _0xa9b7xb['classList']['add'](_0xa9b7xfe);
                    _0xa9b7xb['classList']['add']('no-click')
                }
            });
            _0xa9b7xfd['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                    var _0xa9b7xfe = _0xa9b7xc['parentNode']['getAttribute']('data-highlight');
                    var _0xa9b7xff = _0xa9b7xc['parentNode']['querySelectorAll']('a');
                    _0xa9b7xff['forEach'](function(_0xa9b7xb) {
                        _0xa9b7xb['classList']['remove'](_0xa9b7xfe);
                        _0xa9b7xb['classList']['remove']('no-click')
                    });
                    _0xa9b7xc['classList']['add'](_0xa9b7xfe);
                    _0xa9b7xc['classList']['add']('no-click')
                })
            })
        };

        function _0xa9b7x39(_0xa9b7x100, _0xa9b7x32, _0xa9b7x101) {
            setTimeout(function() {
                if (_0xa9b7x32 === 'show') {
                    return document['getElementById'](_0xa9b7x100)['classList']['add']('menu-active'), document['querySelectorAll']('.menu-hider')[0]['classList']['add']('menu-active')
                } else {
                    return document['getElementById'](_0xa9b7x100)['classList']['remove']('menu-active'), document['querySelectorAll']('.menu-hider')[0]['classList']['remove']('menu-active')
                }
            }, _0xa9b7x101)
        }
        var _0xa9b7x102 = document['querySelectorAll']('[data-auto-activate]');
        if (_0xa9b7x102['length']) {
            setTimeout(function() {
                _0xa9b7x102[0]['classList']['add']('menu-active');
                _0xa9b7xd[0]['classList']['add']('menu-active')
            }, 0)
        };

        function _0xa9b7x103() {
            var _0xa9b7x103 = document['querySelectorAll']('.copyright-year');
            if (_0xa9b7x103) {
                var _0xa9b7x104 = new Date();
                const _0xa9b7x105 = _0xa9b7x104['getFullYear']();
                _0xa9b7x103['forEach'](function(_0xa9b7xb) {
                    _0xa9b7xb['textContent'] = _0xa9b7x105
                })
            }
        }
        var _0xa9b7x106 = document['querySelectorAll']('.check-age');
        if (_0xa9b7x106['length']) {
            _0xa9b7x106[0]['addEventListener']('click', function() {
                var _0xa9b7x107 = document['querySelectorAll']('#date-birth-day')[0]['value'];
                var _0xa9b7x108 = document['querySelectorAll']('#date-birth-month')[0]['value'];
                var _0xa9b7x109 = document['querySelectorAll']('#date-birth-year')[0]['value'];
                var _0xa9b7x10a = 18;
                var _0xa9b7x10b = new Date();
                _0xa9b7x10b['setFullYear'](_0xa9b7x109, _0xa9b7x108 - 1, _0xa9b7x107);
                var _0xa9b7x10c = new Date();
                var _0xa9b7x10d = new Date();
                _0xa9b7x10d['setFullYear'](_0xa9b7x10b['getFullYear']() + _0xa9b7x10a, _0xa9b7x108 - 1, _0xa9b7x107);
                var _0xa9b7x10e = document['querySelectorAll']('#menu-age');
                var _0xa9b7x10f = document['querySelectorAll']('#menu-age-fail');
                var _0xa9b7x110 = document['querySelectorAll']('#menu-age-okay');
                console['log'](_0xa9b7x10c);
                console['log'](_0xa9b7x10d);
                console['log'](_0xa9b7x108);
                if ((_0xa9b7x10c - _0xa9b7x10d) > 0) {
                    console['log']('above 18');
                    _0xa9b7x10e[0]['classList']['remove']('menu-active');
                    _0xa9b7x110[0]['classList']['add']('menu-active')
                } else {
                    _0xa9b7x10e[0]['classList']['remove']('menu-active');
                    _0xa9b7x10f[0]['classList']['add']('menu-active')
                };
                return true
            })
        };
        var _0xa9b7x111 = document['querySelectorAll']('.offline-message');
        if (!_0xa9b7x111['length']) {
            const _0xa9b7x112 = document['createElement']('p');
            const _0xa9b7x113 = document['createElement']('p');
            _0xa9b7x112['className'] = 'offline-message bg-red-dark color-white';
            _0xa9b7x112['textContent'] = 'No internet connection detected';
            _0xa9b7x113['className'] = 'online-message bg-green-dark color-white';
            _0xa9b7x113['textContent'] = 'You are back online';
            document['getElementsByTagName']('body')[0]['appendChild'](_0xa9b7x112);
            document['getElementsByTagName']('body')[0]['appendChild'](_0xa9b7x113)
        };

        function _0xa9b7x114() {
            var _0xa9b7x115 = document['querySelectorAll']('a');
            _0xa9b7x115['forEach'](function(_0xa9b7xb) {
                var _0xa9b7x116 = _0xa9b7xb['getAttribute']('href');
                if (_0xa9b7x116['match'](/.html/)) {
                    _0xa9b7xb['classList']['add']('show-offline');
                    _0xa9b7xb['setAttribute']('data-link', _0xa9b7x116);
                    _0xa9b7xb['setAttribute']('href', '#')
                }
            });
            var _0xa9b7x117 = document['querySelectorAll']('.show-offline');
            _0xa9b7x117['forEach']((_0xa9b7xc) => {
                return _0xa9b7xc['addEventListener']('click', (_0xa9b7x6f) => {
                    document['getElementsByClassName']('offline-message')[0]['classList']['add']('offline-message-active');
                    setTimeout(function() {
                        document['getElementsByClassName']('offline-message')[0]['classList']['remove']('offline-message-active')
                    }, 1500)
                })
            })
        }

        function _0xa9b7x118() {
            var _0xa9b7x119 = document['querySelectorAll']('[data-link]');
            _0xa9b7x119['forEach'](function(_0xa9b7xb) {
                var _0xa9b7x116 = _0xa9b7xb['getAttribute']('data-link');
                if (_0xa9b7x116['match'](/.html/)) {
                    _0xa9b7xb['setAttribute']('href', _0xa9b7x116);
                    _0xa9b7xb['removeAttribute']('data-link', '')
                }
            })
        }
        var _0xa9b7x11a = document['getElementsByClassName']('offline-message')[0];
        var _0xa9b7x11b = document['getElementsByClassName']('online-message')[0];

        function _0xa9b7x11c() {
            _0xa9b7x118();
            _0xa9b7x11b['classList']['add']('online-message-active');
            setTimeout(function() {
                _0xa9b7x11b['classList']['remove']('online-message-active')
            }, 2000);
            console['info']('Connection: Online')
        }

        function _0xa9b7x11d() {
            _0xa9b7x114();
            _0xa9b7x11a['classList']['add']('offline-message-active');
            setTimeout(function() {
                _0xa9b7x11a['classList']['remove']('offline-message-active')
            }, 2000);
            console['info']('Connection: Offline')
        }
        var _0xa9b7x11e = document['querySelectorAll']('.simulate-offline');
        var _0xa9b7x11f = document['querySelectorAll']('.simulate-online');
        if (_0xa9b7x11e['length']) {
            _0xa9b7x11e[0]['addEventListener']('click', function() {
                _0xa9b7x11d()
            });
            _0xa9b7x11f[0]['addEventListener']('click', function() {
                _0xa9b7x11c()
            })
        };

        function _0xa9b7x120(_0xa9b7x6f) {
            var _0xa9b7x121 = navigator['onLine'] ? 'online' : 'offline';
            _0xa9b7x11c()
        }

        function _0xa9b7x122(_0xa9b7x6f) {
            _0xa9b7x11d()
        }
        window['addEventListener']('online', _0xa9b7x120);
        window['addEventListener']('offline', _0xa9b7x122);
        const _0xa9b7x123 = document['querySelectorAll']('.simulate-iphone-badge');
        _0xa9b7x123['forEach']((_0xa9b7xc) => {
            return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                document['getElementsByClassName']('add-to-home')[0]['classList']['add']('add-to-home-visible', 'add-to-home-ios');
                document['getElementsByClassName']('add-to-home')[0]['classList']['remove']('add-to-home-android')
            })
        });
        const _0xa9b7x124 = document['querySelectorAll']('.simulate-android-badge');
        _0xa9b7x124['forEach']((_0xa9b7xc) => {
            return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                document['getElementsByClassName']('add-to-home')[0]['classList']['add']('add-to-home-visible', 'add-to-home-android');
                document['getElementsByClassName']('add-to-home')[0]['classList']['remove']('add-to-home-ios')
            })
        });
        const _0xa9b7x125 = document['querySelectorAll']('.add-to-home');
        _0xa9b7x125['forEach']((_0xa9b7xc) => {
            return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                document['getElementsByClassName']('add-to-home')[0]['classList']['remove']('add-to-home-visible')
            })
        });

        let _0xa9b7x129 = {
            Android: function() {
                return navigator['userAgent']['match'](/Android/i)
            },
            iOS: function() {
                return navigator['userAgent']['match'](/iPhone|iPad|iPod/i)
            },
            any: function() {
                return (_0xa9b7x129.Android() || _0xa9b7x129['iOS']())
            }
        };
        const _0xa9b7x12a = document['getElementsByClassName']('show-android');
        const _0xa9b7x12b = document['getElementsByClassName']('show-ios');
        const _0xa9b7x12c = document['getElementsByClassName']('show-no-device');
        if (!_0xa9b7x129['any']()) {
            for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x12b['length']; _0xa9b7xa++) {
                _0xa9b7x12b[_0xa9b7xa]['classList']['add']('disabled')
            };
            for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x12a['length']; _0xa9b7xa++) {
                _0xa9b7x12a[_0xa9b7xa]['classList']['add']('disabled')
            }
        };
        if (_0xa9b7x129['iOS']()) {
            document['querySelectorAll']('#page')[0]['classList']['add']('device-is-ios');
            for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x12c['length']; _0xa9b7xa++) {
                _0xa9b7x12c[_0xa9b7xa]['classList']['add']('disabled')
            };
            for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x12a['length']; _0xa9b7xa++) {
                _0xa9b7x12a[_0xa9b7xa]['classList']['add']('disabled')
            }
        };
        if (_0xa9b7x129.Android()) {
            document['querySelectorAll']('#page')[0]['classList']['add']('device-is-android');
            for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x12b['length']; _0xa9b7xa++) {
                _0xa9b7x12b[_0xa9b7xa]['classList']['add']('disabled')
            };
            for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x12c['length']; _0xa9b7xa++) {
                _0xa9b7x12c[_0xa9b7xa]['classList']['add']('disabled')
            }
        };
        if (_0xa9b7x2 === true) {
            var _0xa9b7x12d = document['getElementsByTagName']('html')[0];
            if (!_0xa9b7x12d['classList']['contains']('isPWA')) {
                if ('serviceWorker' in navigator) {
                    window['addEventListener']('load', function() {
                        navigator['serviceWorker']['register'](_0xa9b7x8, {
                            scope: _0xa9b7x7
                        })
                    })
                };
                var _0xa9b7x12e = _0xa9b7x5 * 24;
                var _0xa9b7xb5 = Date['now']();
                var _0xa9b7x12f = localStorage['getItem'](_0xa9b7x4 + '-PWA-Timeout-Value');
                if (_0xa9b7x12f == null) {
                    localStorage['setItem'](_0xa9b7x4 + '-PWA-Timeout-Value', _0xa9b7xb5)
                } else {
                    if (_0xa9b7xb5 - _0xa9b7x12f > _0xa9b7x12e * 60 * 60 * 1000) {
                        localStorage['removeItem'](_0xa9b7x4 + '-PWA-Prompt');
                        localStorage['setItem'](_0xa9b7x4 + '-PWA-Timeout-Value', _0xa9b7xb5)
                    }
                };
                const _0xa9b7x130 = document['querySelectorAll']('.pwa-dismiss');
                _0xa9b7x130['forEach']((_0xa9b7xc) => {
                    return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                        const _0xa9b7x131 = document['querySelectorAll']('#menu-install-pwa-android, #menu-install-pwa-ios');
                        for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x131['length']; _0xa9b7xa++) {
                            _0xa9b7x131[_0xa9b7xa]['classList']['remove']('menu-active')
                        };
                        localStorage['setItem'](_0xa9b7x4 + '-PWA-Timeout-Value', _0xa9b7xb5);
                        localStorage['setItem'](_0xa9b7x4 + '-PWA-Prompt', 'install-rejected');
                        console['log']('PWA Install Rejected. Will Show Again in ' + (_0xa9b7x5) + ' Days')
                    })
                });
                const _0xa9b7x131 = document['querySelectorAll']('#menu-install-pwa-android, #menu-install-pwa-ios');
                if (_0xa9b7x131['length']) {
                    if (_0xa9b7x129.Android()) {
                        if (localStorage['getItem'](_0xa9b7x4 + '-PWA-Prompt') != 'install-rejected') {
                            function _0xa9b7x132() {
                                setTimeout(function() {
                                    if (!window['matchMedia']('(display-mode: fullscreen)')['matches']) {
                                        console['log']('Triggering PWA Window for Android');
                                        document['getElementById']('menu-install-pwa-android')['classList']['add']('menu-active');
                                        document['querySelectorAll']('.menu-hider')[0]['classList']['add']('menu-active')
                                    }
                                }, 3500)
                            }
                            var _0xa9b7x133;
                            window['addEventListener']('beforeinstallprompt', (_0xa9b7xb) => {
                                _0xa9b7xb['preventDefault']();
                                _0xa9b7x133 = _0xa9b7xb;
                                _0xa9b7x132()
                            })
                        };
                        const _0xa9b7x134 = document['querySelectorAll']('.pwa-install');
                        _0xa9b7x134['forEach']((_0xa9b7xc) => {
                            return _0xa9b7xc['addEventListener']('click', (_0xa9b7xb) => {
                                _0xa9b7x133['prompt']();
                                _0xa9b7x133['userChoice']['then']((_0xa9b7x135) => {
                                    if (_0xa9b7x135['outcome'] === 'accepted') {
                                        console['log']('Added')
                                    } else {
                                        localStorage['setItem'](_0xa9b7x4 + '-PWA-Timeout-Value', _0xa9b7xb5);
                                        localStorage['setItem'](_0xa9b7x4 + '-PWA-Prompt', 'install-rejected');
                                        setTimeout(function() {
                                            if (!window['matchMedia']('(display-mode: fullscreen)')['matches']) {
                                                document['getElementById']('menu-install-pwa-android')['classList']['remove']('menu-active');
                                                document['querySelectorAll']('.menu-hider')[0]['classList']['remove']('menu-active')
                                            }
                                        }, 50)
                                    };
                                    _0xa9b7x133 = null
                                })
                            })
                        });
                        window['addEventListener']('appinstalled', (_0xa9b7x136) => {
                            document['getElementById']('menu-install-pwa-android')['classList']['remove']('menu-active');
                            document['querySelectorAll']('.menu-hider')[0]['classList']['remove']('menu-active')
                        })
                    };
                    if (_0xa9b7x129['iOS']()) {
                        if (localStorage['getItem'](_0xa9b7x4 + '-PWA-Prompt') != 'install-rejected') {
                            setTimeout(function() {
                                if (!window['matchMedia']('(display-mode: fullscreen)')['matches']) {
                                    console['log']('Triggering PWA Window for iOS');
                                    document['getElementById']('menu-install-pwa-ios')['classList']['add']('menu-active');
                                    document['querySelectorAll']('.menu-hider')[0]['classList']['add']('menu-active')
                                }
                            }, 3500)
                        }
                    }
                }
            };
            _0xa9b7x12d['setAttribute']('class', 'isPWA')
        };
        if (_0xa9b7x6 === true) {
            caches['delete']('workbox-runtime')['then'](function() {});
            sessionStorage['clear']();
            caches['keys']()['then']((_0xa9b7x137) => {
                _0xa9b7x137['forEach']((_0xa9b7x138) => {
                    caches['delete'](_0xa9b7x138)
                })
            })
        };
        var _0xa9b7x139 = new LazyLoad();
        var _0xa9b7x13a, _0xa9b7x13b, _0xa9b7x13c, _0xa9b7x13d;
        var _0xa9b7x13e = 'plugins/';
        let _0xa9b7x13f = [{
            id: 'uniqueID',
            plug: 'pluginName/plugin.js',
            call: 'pluginName/pluginName-call.js',
            style: 'pluginName/pluginName-style.css',
            trigger: '.pluginTriggerClass'
        }, {
            id: 'chart',
            plug: 'charts/charts.js',
            call: 'charts/charts-call-charts.js',
            trigger: '.chart'
        }, {
            id: 'chart',
            plug: 'charts/charts.js',
            call: 'charts/charts-call-wallet.js',
            trigger: '.wallet-chart'
        }, {
            id: 'graph',
            plug: 'charts/charts.js',
            call: 'charts/charts-call-graphs.js',
            trigger: '.graph'
        }, {
            id: 'count',
            plug: 'countdown/countdown.js',
            trigger: '.countdown'
        }, {
            id: 'gallery',
            plug: 'glightbox/glightbox.js',
            call: 'glightbox/glightbox-call.js',
            style: 'glightbox/glightbox.css',
            trigger: '[data-gallery]'
        }, {
            id: 'gallery-views',
            plug: 'galleryViews/gallery-views.js',
            trigger: '.gallery-view-controls'
        }, {
            id: 'filter',
            plug: 'filterizr/filterizr.js',
            call: 'filterizr/filterizr-call.js',
            style: 'filterizr/filterizr.css',
            trigger: '.gallery-filter'
        }];
        for (let _0xa9b7xa = 0; _0xa9b7xa < _0xa9b7x13f['length']; _0xa9b7xa++) {
            if (document['querySelectorAll']('.' + _0xa9b7x13f[_0xa9b7xa]['id'] + '-c')['length']) {
                document['querySelectorAll']('.' + _0xa9b7x13f[_0xa9b7xa]['id'] + '-c')[0]['remove']()
            };
            var _0xa9b7x140 = document['querySelectorAll'](_0xa9b7x13f[_0xa9b7xa]['trigger']);
            if (_0xa9b7x140['length']) {
                var _0xa9b7x141 = document['getElementsByTagName']('script')[1],
                    _0xa9b7x142 = document['createElement']('script');
                _0xa9b7x142['type'] = 'text/javascript';
                _0xa9b7x142['className'] = _0xa9b7x13f[_0xa9b7xa]['id'] + '-p';
                _0xa9b7x142['src'] = _0xa9b7x13e + _0xa9b7x13f[_0xa9b7xa]['plug'];
                _0xa9b7x142['addEventListener']('load', function() {
                    if (_0xa9b7x13f[_0xa9b7xa]['call'] !== undefined) {
                        var _0xa9b7x143 = document['getElementsByTagName']('script')[2],
                            _0xa9b7x144 = document['createElement']('script');
                        _0xa9b7x144['type'] = 'text/javascript';
                        _0xa9b7x144['className'] = _0xa9b7x13f[_0xa9b7xa]['id'] + '-c';
                        _0xa9b7x144['src'] = _0xa9b7x13e + _0xa9b7x13f[_0xa9b7xa]['call'];
                        _0xa9b7x143['parentNode']['insertBefore'](_0xa9b7x144, _0xa9b7x143)
                    }
                });
                if (!document['querySelectorAll']('.' + _0xa9b7x13f[_0xa9b7xa]['id'] + '-p')['length']) {
                    _0xa9b7x141['parentNode']['insertBefore'](_0xa9b7x142, _0xa9b7x141)
                } else {
                    setTimeout(function() {
                        var _0xa9b7x141 = document['getElementsByTagName']('script')[1],
                            _0xa9b7x142 = document['createElement']('script');
                        _0xa9b7x142['type'] = 'text/javascript';
                        _0xa9b7x142['className'] = _0xa9b7x13f[_0xa9b7xa]['id'] + '-c';
                        _0xa9b7x142['src'] = _0xa9b7x13e + _0xa9b7x13f[_0xa9b7xa]['call'];
                        _0xa9b7x141['parentNode']['insertBefore'](_0xa9b7x142, _0xa9b7x141)
                    }, 50)
                };
                if (_0xa9b7x13f[_0xa9b7xa]['style'] !== undefined) {
                    if (!document['querySelectorAll']('.' + _0xa9b7x13f[_0xa9b7xa]['id'] + '-s')['length']) {
                        var _0xa9b7x145 = document['createElement']('link');
                        _0xa9b7x145['className'] = _0xa9b7x13f[_0xa9b7xa]['id'] + '-s';
                        _0xa9b7x145['rel'] = 'stylesheet';
                        _0xa9b7x145['type'] = 'text/css';
                        _0xa9b7x145['href'] = _0xa9b7x13e + _0xa9b7x13f[_0xa9b7xa]['style'];
                        document['getElementsByTagName']('head')[0]['appendChild'](_0xa9b7x145)
                    }
                }
            }
        }
    }
    if ('scrollRestoration' in window['history']) {
        window['history']['scrollRestoration'] = 'manual'
    };
    if (_0xa9b7x3 === true) {
        if (window['location']['protocol'] !== 'file:') {
            const _0xa9b7x146 = {
                containers: ['#page'],
                cache: false,
                animateHistoryBrowsing: false,
                plugins: [new SwupPreloadPlugin()],
                linkSelector: 'a:not(.external-link):not(.default-link):not([href^=\"https\"]):not([href^=\"http\"]):not([data-gallery])'
            };
            const _0xa9b7x147 = new Swup(_0xa9b7x146);
            document['addEventListener']('swup:pageView', (_0xa9b7xb) => {
                _0xa9b7x9()
            })
        }
    };
    _0xa9b7x9()
})