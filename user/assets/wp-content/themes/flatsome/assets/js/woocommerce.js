! function(t) {
    function e(o) {
        if (i[o]) return i[o].exports;
        var r = i[o] = {
            exports: {},
            id: o,
            loaded: !1
        };
        return t[o].call(r.exports, r, r.exports, e), r.loaded = !0, r.exports
    }
    var i = {};
    return e.m = t, e.c = i, e.p = "", e(0)
}({
    0: function(t, e, i) {
        t.exports = i(119)
    },
    16: function(t, e) {
        t.exports = window.jQuery
    },
    119: function(t, e, i) {
        "use strict";

        function o(t) {
            if (jQuery(".cart-item .nav-dropdown").length) jQuery(".cart-item").addClass("current-dropdown cart-active"), jQuery(".shop-container").click(function() {
                jQuery(".cart-item").removeClass("current-dropdown cart-active")
            }), jQuery(".cart-item").hover(function() {
                jQuery(".cart-active").removeClass("cart-active")
            }), setTimeout(function() {
                jQuery(".cart-active").removeClass("current-dropdown")
            }, t);
            else {
                var e = jQuery.magnificPopup.open ? 0 : 300;
                e && jQuery.magnificPopup.close(), setTimeout(function() {
                    jQuery(".cart-item .off-canvas-toggle").click()
                }, e)
            }
        }
        i(120), i(121), i(122), i(123), i(124);
        var r = !1;
        /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) || (r = jQuery(".has-image-zoom .slide").easyZoom({
            loadingNotice: "",
            preventClicks: !1
        })), jQuery("table.my_account_orders").wrap('<div class="touch-scroll-table"/>'), jQuery("a.woocommerce-review-link").click(function(t) {
            jQuery.scrollTo(".reviews_tab", {
                duration: 300,
                offset: -150
            })
        }), jQuery(".single_add_to_cart_button").click(function() {
            var t = jQuery(this),
                e = t.closest("form.cart");
            e ? e.on("submit", function() {
                t.addClass("loading")
            }) : t.hasClass("disabled") || t.addClass("loading")
        });
        var a = jQuery(".product-thumbnails .first img").attr("data-src") ? jQuery(".product-thumbnails .first img").attr("data-src") : jQuery(".product-thumbnails .first img").attr("src"),
            s = jQuery("form.variations_form"),
            n = null,
            c = {
                setImageZoomSrc: function() {
                    r && r.length && (n = r.filter(".has-image-zoom .slide.first").data("easyZoom"), n.swap(jQuery(".has-image-zoom .slide.first img").attr("src"), jQuery(".has-image-zoom .slide.first img").attr("data-large_image")))
                },
                selectSliderFirstImage: function() {
                    jQuery(".product-gallery-slider").data("flickity") && jQuery(".product-gallery-slider").flickity("select", 0)
                }
            };
        s.on("show_variation", function(t, e) {
            e.hasOwnProperty("image") && e.image.thumb_src ? (jQuery(".product-gallery-slider-old .slide.first img, .sticky-add-to-cart-img, .product-thumbnails .first img, .product-gallery-slider .slide.first .zoomImg").attr("src", e.image.thumb_src).attr("srcset", ""), c.selectSliderFirstImage(), c.setImageZoomSrc()) : jQuery(".product-thumbnails .first img").attr("src", a)
        }), s.on("click", ".reset_variations", function() {
            jQuery(".product-thumbnails .first img, .sticky-add-to-cart-img").attr("src", a), c.selectSliderFirstImage(), c.setImageZoomSrc()
        }), jQuery(document).ready(function() {
            jQuery(".has-lightbox .product-gallery-slider").each(function() {
                jQuery(this).magnificPopup({
                    delegate: "a",
                    type: "image",
                    tLoading: '<div class="loading-spin centered dark"></div>',
                    closeBtnInside: !1,
                    gallery: {
                        enabled: !0,
                        navigateByImgClick: !0,
                        preload: [0, 1],
                        arrowMarkup: '<button class="mfp-arrow mfp-arrow-%dir%" title="%title%"><i class="icon-angle-%dir%"></i></button>'
                    },
                    image: {
                        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                        verticalFit: !1
                    }
                })
            })
        }), jQuery(".zoom-button").click(function(t) {
            jQuery(".product-gallery-slider").find(".is-selected a").click(), t.preventDefault()
        }), jQuery("body").on("added_to_cart", function() {
            o("5000")
        }), jQuery(document.body).on("updated_cart_totals", function() {
            var t = jQuery(".cart-wrapper");
            Flatsome.attach("lazy-load-images", t), Flatsome.attach("quick-view", t), Flatsome.attach("wishlist", t), Flatsome.attach("cart-refresh", t)
        }), jQuery(document).ajaxComplete(function() {
            Flatsome.attach(jQuery(".quantity").parent())
        }), jQuery(document).on("yith_infs_adding_elem", function(t) {
            Flatsome.attach(jQuery(".shop-container"))
        }), jQuery(document).ready(function() {
            jQuery("span.added-to-cart").length && o("5000")
        }), jQuery(".disable-lightbox a").click(function(t) {
            t.preventDefault()
        }), jQuery(document).ready(function() {
            jQuery("body").hasClass("single-product") && window.location.hash.indexOf("#comment-") >= 0 && jQuery("a", ".reviews_tab.active").trigger("click")
        }), jQuery(document).ready(function() {
            if (jQuery(".custom-product-page").length) {
                var t = jQuery("#respond p.stars");
                if (t.length > 1) {
                    var e = t[0].outerHTML;
                    t.remove(), jQuery('select[id="rating"]').hide().before(e)
                }
            }
        }), jQuery(".sticky-add-to-cart-wrapper").waypoint(function(t) {
            var e = jQuery(this.element),
                i = jQuery(this.element).find(".sticky-add-to-cart");
            jQuery(".wc-variation-selection-needed").click(function() {
                jQuery.scrollTo(".sticky-add-to-cart-wrapper", {
                    duration: 0,
                    offset: -200
                })
            }), "down" === t && (e.css({
                height: e.outerHeight()
            }), i.addClass("sticky-add-to-cart--active"), jQuery("body").addClass("has-sticky-product-cart")), "up" === t && (i.removeClass("sticky-add-to-cart--active"), e.css({
                height: "auto"
            }), jQuery("body").removeClass("has-sticky-product-cart"))
        }), setTimeout(function() {
            jQuery(document.body).on("country_to_state_changed", function() {
                "undefined" != typeof floatlabels && floatlabels.rebuild()
            })
        }, 500)
    },
    120: function(t, e, i) {
        var o, r;
        /*!
         * @name        easyzoom
         * @author       <>
         * @modified    Wednesday, October 3rd, 2018
         * @version     2.5.0
         */
        ! function(a, s) {
            "use strict";
            o = [i(16)], r = function(t) {
                s(t)
            }.apply(e, o), !(void 0 !== r && (t.exports = r))
        }(this, function(t) {
            "use strict";

            function e(e, i) {
                this.$target = t(e), this.opts = t.extend({}, c, i, this.$target.data()), void 0 === this.isOpen && this._init()
            }
            var i, o, r, a, s, n, c = {
                loadingNotice: "Loading image",
                errorNotice: "The image could not be loaded",
                errorDuration: 2500,
                linkAttribute: "href",
                preventClicks: !0,
                beforeShow: t.noop,
                beforeHide: t.noop,
                onShow: t.noop,
                onHide: t.noop,
                onMove: t.noop
            };
            e.prototype._init = function() {
                this.$link = this.$target.find("a"), this.$image = this.$target.find("img"), this.$flyout = t('<div class="easyzoom-flyout" />'), this.$notice = t('<div class="easyzoom-notice" />'), this.$target.on({
                    "mousemove.easyzoom touchmove.easyzoom": t.proxy(this._onMove, this),
                    "mouseleave.easyzoom touchend.easyzoom": t.proxy(this._onLeave, this),
                    "mouseenter.easyzoom touchstart.easyzoom": t.proxy(this._onEnter, this)
                }), this.opts.preventClicks && this.$target.on("click.easyzoom", function(t) {
                    t.preventDefault()
                })
            }, e.prototype.show = function(t, e) {
                var s = this;
                if (!1 !== this.opts.beforeShow.call(this)) {
                    if (!this.isReady) return this._loadImage(this.$link.attr(this.opts.linkAttribute), function() {
                        !s.isMouseOver && e || s.show(t)
                    });
                    this.$target.append(this.$flyout);
                    var n = this.$target.outerWidth(),
                        c = this.$target.outerHeight(),
                        u = this.$flyout.width(),
                        l = this.$flyout.height(),
                        d = this.$zoom.width(),
                        h = this.$zoom.height();
                    (i = d - u) < 0 && (i = 0), (o = h - l) < 0 && (o = 0), r = i / n, a = o / c, this.isOpen = !0, this.opts.onShow.call(this), t && this._move(t)
                }
            }, e.prototype._onEnter = function(t) {
                var e = t.originalEvent.touches;
                this.isMouseOver = !0, e && 1 != e.length || (t.preventDefault(), this.show(t, !0))
            }, e.prototype._onMove = function(t) {
                this.isOpen && (t.preventDefault(), this._move(t))
            }, e.prototype._onLeave = function() {
                this.isMouseOver = !1, this.isOpen && this.hide()
            }, e.prototype._onLoad = function(t) {
                t.currentTarget.width && (this.isReady = !0, this.$notice.detach(), this.$flyout.html(this.$zoom), this.$target.removeClass("is-loading").addClass("is-ready"), t.data.call && t.data())
            }, e.prototype._onError = function() {
                var t = this;
                this.$notice.text(this.opts.errorNotice), this.$target.removeClass("is-loading").addClass("is-error"), this.detachNotice = setTimeout(function() {
                    t.$notice.detach(), t.detachNotice = null
                }, this.opts.errorDuration)
            }, e.prototype._loadImage = function(e, i) {
                var o = new Image;
                this.$target.addClass("is-loading").append(this.$notice.text(this.opts.loadingNotice)), this.$zoom = t(o).on("error", t.proxy(this._onError, this)).on("load", i, t.proxy(this._onLoad, this)), o.style.position = "absolute", o.src = e
            }, e.prototype._move = function(t) {
                if (0 === t.type.indexOf("touch")) {
                    var e = t.touches || t.originalEvent.touches;
                    s = e[0].pageX, n = e[0].pageY
                } else s = t.pageX || s, n = t.pageY || n;
                var c = this.$target.offset(),
                    u = n - c.top,
                    l = s - c.left,
                    d = Math.ceil(u * a),
                    h = Math.ceil(l * r);
                if (h < 0 || d < 0 || i < h || o < d) this.hide();
                else {
                    var p = -1 * d,
                        m = -1 * h;
                    this.$zoom.css({
                        top: p,
                        left: m
                    }), this.opts.onMove.call(this, p, m)
                }
            }, e.prototype.hide = function() {
                this.isOpen && !1 !== this.opts.beforeHide.call(this) && (this.$flyout.detach(), this.isOpen = !1, this.opts.onHide.call(this))
            }, e.prototype.swap = function(e, i, o) {
                this.hide(), this.isReady = !1, this.detachNotice && clearTimeout(this.detachNotice), this.$notice.parent().length && this.$notice.detach(), this.$target.removeClass("is-loading is-ready is-error"), this.$image.attr({
                    src: e,
                    srcset: t.isArray(o) ? o.join() : o
                }), this.$link.attr(this.opts.linkAttribute, i)
            }, e.prototype.teardown = function() {
                this.hide(), this.$target.off(".easyzoom").removeClass("is-loading is-ready is-error"), this.detachNotice && clearTimeout(this.detachNotice), delete this.$link, delete this.$zoom, delete this.$image, delete this.$notice, delete this.$flyout, delete this.isOpen, delete this.isReady
            }, t.fn.easyZoom = function(i) {
                return this.each(function() {
                    var o = t.data(this, "easyZoom");
                    o ? void 0 === o.isOpen && o._init() : t.data(this, "easyZoom", new e(this, i))
                })
            }
        })
    },
    121: function(t, e) {
        "use strict";
        Flatsome.plugin("addQty", function(t, e) {
            var i = jQuery(t);
            i.on("click", ".plus, .minus", function() {
                var t = jQuery(this),
                    e = t.closest(".quantity").find(".qty"),
                    i = parseFloat(e.val()),
                    o = parseFloat(e.attr("max")),
                    r = parseFloat(e.attr("min")),
                    a = e.attr("step");
                i && "" !== i && "NaN" !== i || (i = 0), "" !== o && "NaN" !== o || (o = ""), "" !== r && "NaN" !== r || (r = 0), "any" !== a && "" !== a && void 0 !== a && "NaN" !== parseFloat(a) || (a = 1), t.is(".plus") ? o && (o === i || i > o) ? e.val(o) : e.val(i + parseFloat(a)) : r && (r === i || i < r) ? e.val(r) : i > 0 && e.val(i - parseFloat(a)), e.trigger("change")
            })
        })
    },
    122: function(t, e) {
        "use strict";
        Flatsome.behavior("add-qty", {
            attach: function(t) {
                jQuery(".quantity", t).addQty()
            }
        })
    },
    123: function(t, e) {
        "use strict";
        Flatsome.behavior("equalize-box", {
            attach: function() {
                var t = {
                    productCount: 0,
                    ScreenSize: {
                        LARGE: 1,
                        MEDIUM: 2,
                        SMALL: 3
                    },
                    equalize: function(t, e) {
                        this.colPerRow = this.getColsPerRow(t), 1 !== this.colPerRow && (this.maxHeight = 0, this.rowEnd = this.colPerRow, this.$elements = [], this.rating = {
                            present: !1,
                            height: 0,
                            dummy: '<div class="js-star-rating star-rating" style="opacity: 0; visibility: hidden"></div>'
                        }, this.loop(e))
                    },
                    getColsPerRow: function(t) {
                        var e = jQuery(".shop-container .products").attr("class"),
                            i = /large-columns-(\d+)/g,
                            o = /medium-columns-(\d+)/g,
                            r = /small-columns-(\d+)/g,
                            a = void 0;
                        switch (t) {
                            case this.ScreenSize.LARGE:
                                return a = i.exec(e), a ? parseInt(a[1]) : 3;
                            case this.ScreenSize.MEDIUM:
                                return a = o.exec(e), a ? parseInt(a[1]) : 3;
                            case this.ScreenSize.SMALL:
                                return a = r.exec(e), a ? parseInt(a[1]) : 2
                        }
                    },
                    maybeAddDummyRating: function(t) {
                        var e = t;
                        this.rating.present && e.hasClass("price-wrapper") && (e.children(".star-rating").length || (e.prepend(this.rating.dummy), e.children(".js-star-rating").height(this.rating.height)))
                    },
                    loop: function(t) {
                        var e = this;
                        jQuery(t).each(function(t) {
                            var i = jQuery(this);
                            e.$elements.push(i), i.height(""), i.height() > e.maxHeight && (e.maxHeight = i.height()), i.children(".js-star-rating").remove();
                            var o = i.children(".star-rating");
                            o.length && (e.rating.present = !0, e.rating.height = o.height()), t !== e.rowEnd - 1 && t !== e.productCount - 1 || (e.$elements.forEach(function(t) {
                                t.height(e.maxHeight), e.maybeAddDummyRating(t)
                            }), e.rowEnd += e.colPerRow, e.maxHeight = 0, e.$elements = [], e.rating.present = !1)
                        })
                    },
                    getScreenSize: function() {
                        return window.matchMedia("(min-width: 850px)").matches ? this.ScreenSize.LARGE : window.matchMedia("(min-width: 550px) and (max-width: 849px)").matches ? this.ScreenSize.MEDIUM : window.matchMedia("(max-width: 549px)").matches ? this.ScreenSize.SMALL : void 0
                    },
                    init: function() {
                        if (jQuery(".products.equalize-box").length) {
                            var t = this;
                            if (this.productCount = jQuery(".products .product-small.box").length, this.productCount) {
                                var e = [".products .box-text .product-title", ".products .box-text .price-wrapper", ".products .box-text .box-excerpt", ".products .box-text .add-to-cart-button"],
                                    i = t.getScreenSize();
                                e.forEach(function(e) {
                                    t.equalize(i, e)
                                })
                            }
                        }
                    }
                };
                t.init(), jQuery(window).resize(function() {
                    t.init()
                })
            }
        })
    },
    124: function(t, e) {
        "use strict";
        Flatsome.behavior("quick-view", {
            attach: function(t) {
                jQuery(".quick-view", t).each(function(t, e) {
                    jQuery(e).hasClass("quick-view-added") || (jQuery(e).click(function(t) {
                        if ("" != jQuery(this).attr("data-prod")) {
                            jQuery(this).parent().parent().addClass("processing");
                            var e = jQuery(this).attr("data-prod"),
                                i = {
                                    action: "flatsome_quickview",
                                    product: e
                                };
                            jQuery.post(flatsomeVars.ajaxurl, i, function(t) {
                                jQuery(".processing").removeClass("processing"), jQuery.magnificPopup.open({
                                    removalDelay: 300,
                                    closeBtnInside: !0,
                                    autoFocusLast: !1,
                                    items: {
                                        src: '<div class="product-lightbox lightbox-content">' + t + "</div>",
                                        type: "inline"
                                    }
                                });
                                var e = jQuery(".product-gallery-slider img", t).length,
                                    i = e > 1;
                                setTimeout(function() {
                                    jQuery(".product-lightbox").imagesLoaded(function() {
                                        jQuery(".product-lightbox .slider").flickity({
                                            cellAlign: "left",
                                            wrapAround: !0,
                                            autoPlay: !1,
                                            prevNextButtons: !0,
                                            adaptiveHeight: !0,
                                            imagesLoaded: !0,
                                            dragThreshold: 15,
                                            pageDots: i
                                        })
                                    })
                                }, 300);
                                var o = jQuery(".product-lightbox form.variations_form");
                                jQuery(".product-lightbox form").hasClass("variations_form") && o.wc_variation_form();
                                var r = jQuery(".product-lightbox .product-gallery-slider"),
                                    a = jQuery(".product-lightbox .product-gallery-slider .slide.first img"),
                                    s = jQuery(".product-lightbox .product-gallery-slider .slide.first a"),
                                    n = a.attr("data-src") ? a.attr("data-src") : a.attr("src");
                                o.on("show_variation", function(t, e) {
                                    e.image.src ? (a.attr("src", e.image.src).attr("srcset", ""), s.attr("href", e.image_link), r.flickity("select", 0)) : e.image_src && (a.attr("src", e.image_src).attr("srcset", ""), s.attr("href", e.image_link), r.flickity("select", 0))
                                }), o.on("click", ".reset_variations", function() {
                                    a.attr("src", n).attr("srcset", ""), r.flickity("select", 0)
                                }), jQuery(".product-lightbox .quantity").addQty()
                            }), t.preventDefault()
                        }
                    }), jQuery(e).addClass("quick-view-added"))
                })
            }
        })
    }
});