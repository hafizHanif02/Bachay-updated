"use strict";

function _typeof(e) {
    return (_typeof =
        "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
            ? function (e) {
                  return typeof e;
              }
            : function (e) {
                  return e &&
                      "function" == typeof Symbol &&
                      e.constructor === Symbol &&
                      e !== Symbol.prototype
                      ? "symbol"
                      : typeof e;
              })(e);
}

function ownKeys(t, e) {
    var r = Object.keys(t);
    if (Object.getOwnPropertySymbols) {
        var n = Object.getOwnPropertySymbols(t);
        e &&
            (n = n.filter(function (e) {
                return Object.getOwnPropertyDescriptor(t, e).enumerable;
            })),
            r.push.apply(r, n);
    }
    return r;
}

function _objectSpread(t) {
    for (var e = 1; e < arguments.length; e++) {
        var r = null != arguments[e] ? arguments[e] : {};
        e % 2
            ? ownKeys(Object(r), !0).forEach(function (e) {
                  _defineProperty(t, e, r[e]);
              })
            : Object.getOwnPropertyDescriptors
            ? Object.defineProperties(t, Object.getOwnPropertyDescriptors(r))
            : ownKeys(Object(r)).forEach(function (e) {
                  Object.defineProperty(
                      t,
                      e,
                      Object.getOwnPropertyDescriptor(r, e)
                  );
              });
    }
    return t;
}

function _defineProperty(e, t, r) {
    return (
        t in e
            ? Object.defineProperty(e, t, {
                  value: r,
                  enumerable: !0,
                  configurable: !0,
                  writable: !0,
              })
            : (e[t] = r),
        e
    );
}

!(function (t) {
    var e = {
        init: function () {
            e.masonryGrid(),
                e.stickyNavbar(),
                e.stuckNavbarMenuToggle(),
                e.passwordVisibilityToggle(),
                e.customFileInput(),
                e.fileDropArea(),
                e.formValidation(),
                e.multilevelDropdown(),
                e.smoothScroll(),
                e.scrollTopButton(),
                e.offcanvasSidebar(),
                e.tooltips(),
                e.popovers(),
                e.toasts(),
                e.disableDropdownAutohide(),
                e.carousel(),
                e.gallery(),
                e.productGallery(),
                e.imageZoom(),
                e.videoPopupBtn(),
                e.ajaxifySubscribeForm(),
                e.rangeSlider(),
                e.filterList(),
                e.dataFilter(),
                e.labelUpdate(),
                e.radioTabs(),
                e.countdown(),
                e.creditCard(),
                e.charts();
        },
        masonryGrid: function () {
            var e,
                t = document.querySelectorAll(".cz-masonry-grid");
            if (null !== t)
                for (var r = 0; r < t.length; r++)
                    (e = new Shuffle(t[r], {
                        itemSelector: ".grid-item",
                        sizer: ".grid-item",
                    })),
                        imagesLoaded(t[r]).on("progress", function () {
                            e.layout();
                        });
        },
        stickyNavbar: function () {
            var t = document.querySelector(".navbar-sticky");
            if (null != t) {
                var e = t.classList,
                    r = t.offsetHeight;
                e.contains("navbar-floating") && e.contains("navbar-dark")
                    ? window.addEventListener("scroll", function (e) {
                          500 < e.currentTarget.pageYOffset
                              ? (t.classList.remove("navbar-dark"),
                                t.classList.add("navbar-light", "navbar-stuck"))
                              : (t.classList.remove(
                                    "navbar-light",
                                    "navbar-stuck"
                                ),
                                t.classList.add("navbar-dark"));
                      })
                    : e.contains("navbar-floating") &&
                      e.contains("navbar-light")
                    ? window.addEventListener("scroll", function (e) {
                          500 < e.currentTarget.pageYOffset
                              ? t.classList.add("navbar-stuck")
                              : t.classList.remove("navbar-stuck");
                      })
                    : window.addEventListener("scroll", function (e) {
                          500 < e.currentTarget.pageYOffset
                              ? ((document.body.style.paddingTop = r + "px"),
                                t.classList.add("navbar-stuck"))
                              : ((document.body.style.paddingTop = ""),
                                t.classList.remove("navbar-stuck"));
                      });
            }
        },
        stuckNavbarMenuToggle: function () {
            var e = document.querySelector(".navbar-stuck-toggler"),
                t = document.querySelector(".navbar-stuck-menu");
            e.addEventListener("click", function (e) {
                t.classList.toggle("show"), e.preventDefault();
                this.classList.toggle("show");
            });
        },
        passwordVisibilityToggle: function () {
            for (
                var r = document.querySelectorAll(".password-toggle"),
                    e = function (e) {
                        var t = r[e].querySelector(".form-control");
                        r[e]
                            .querySelector(".password-toggle-btn")
                            .addEventListener(
                                "click",
                                function (e) {
                                    "checkbox" === e.target.type &&
                                        (e.target.checked
                                            ? (t.type = "text")
                                            : (t.type = "password"));
                                },
                                !1
                            );
                    },
                    t = 0;
                t < r.length;
                t++
            )
                e(t);
        },
        customFileInput: function () {
            bsCustomFileInput.init();
        },
        fileDropArea: function () {
            for (
                var t = document.querySelectorAll(".cz-file-drop-area"),
                    e = function (e) {
                        var o = t[e].querySelector(".cz-file-drop-input"),
                            a = t[e].querySelector(".cz-file-drop-message"),
                            i = t[e].querySelector(".cz-file-drop-icon");
                        t[e]
                            .querySelector(".cz-file-drop-btn")
                            .addEventListener("click", function () {
                                o.click();
                            }),
                            o.addEventListener("change", function () {
                                if (o.files && o.files[0]) {
                                    var e = new FileReader();
                                    (e.onload = function (e) {
                                        var t = e.target.result,
                                            r = o.files[0].name;
                                        if (
                                            ((a.innerHTML = r),
                                            t.startsWith("data:image"))
                                        ) {
                                            var n = new Image();
                                            (n.src = t),
                                                (n.onload = function () {
                                                    (i.className =
                                                        "cz-file-drop-preview img-thumbnail rounded"),
                                                        (i.innerHTML =
                                                            '<img src="' +
                                                            n.src +
                                                            '" alt="' +
                                                            r +
                                                            '">'),
                                                        console.log(this.width);
                                                });
                                        } else
                                            t.startsWith("data:video")
                                                ? ((i.innerHTML = ""),
                                                  (i.className = ""),
                                                  (i.className =
                                                      "cz-file-drop-icon czi-video"))
                                                : ((i.innerHTML = ""),
                                                  (i.className = ""),
                                                  (i.className =
                                                      "cz-file-drop-icon czi-document"));
                                    }),
                                        e.readAsDataURL(o.files[0]);
                                }
                            });
                    },
                    r = 0;
                r < t.length;
                r++
            )
                e(r);
        },
        formValidation: function () {
            window.addEventListener(
                "load",
                function () {
                    var e = document.getElementsByClassName("needs-validation");
                    Array.prototype.filter.call(e, function (t) {
                        t.addEventListener(
                            "submit",
                            function (e) {
                                !1 === t.checkValidity() &&
                                    (e.preventDefault(), e.stopPropagation()),
                                    t.classList.add("was-validated");
                            },
                            !1
                        );
                    });
                },
                !1
            );
        },
        multilevelDropdown: function () {
            t(".dropdown-menu [data-toggle='dropdown']").on(
                "click",
                function (e) {
                    
                    e.preventDefault(),
                        e.stopPropagation(),
                        t(this).siblings().toggleClass("show"),
                        t(this).next().hasClass("show") ||
                            t(this)
                                .parents(".dropdown-menu")
                                .first()
                                .find(".show")
                                .removeClass("show"),
                        t(this)
                            .parents("li.nav-item.dropdown.show")
                            .on("hidden.bs.dropdown", function () {
                                t(".dropdown-submenu .show").removeClass(
                                    "show"
                                );
                            });
                }
            );
        },
        smoothScroll: function () {
            new SmoothScroll("[data-scroll]", {
                speed: 800,
                speedAsDuration: !0,
                offset: 40,
                header: "[data-scroll-header]",
                updateURL: !1,
            });
        },
        scrollTopButton: function () {
            var t = document.querySelector(".btn-scroll-top");
            if (null != t) {
                var r = parseInt(600, 10);
                window.addEventListener("scroll", function (e) {
                    e.currentTarget.pageYOffset > r
                        ? t.classList.add("show")
                        : t.classList.remove("show");
                });
            }
        },
        offcanvasSidebar: function () {
            for (
                var e = document.querySelectorAll('[data-toggle="sidebar"]'),
                    t = document.querySelectorAll('[data-dismiss="sidebar"]'),
                    r = document.querySelector("body"),
                    n = 0;
                n < e.length;
                n++
            )
                e[n].addEventListener("click", function (e) {
                    e.preventDefault();
                    var t = e.currentTarget.getAttribute("href");
                    document.querySelector(t).classList.add("show"),
                        r.classList.add("offcanvas-open");
                });
            for (var o = 0; o < t.length; o++)
                t[o].addEventListener("click", function (e) {
                    e.currentTarget
                        .closest(".cz-sidebar")
                        .classList.remove("show"),
                        r.classList.remove("offcanvas-open");
                });
        },
        tooltips: function () {
            t('[data-toggle="tooltip"]').tooltip();
        },
        popovers: function () {
            t('[data-toggle="popover"]').popover();
        },
        toasts: function () {
            t('[data-toggle="toast"]').on("click", function () {
                var e = t(this).data("target");
                t(e).toast("show");
            });
        },
        disableDropdownAutohide: function () {
            for (
                var e = document.querySelectorAll(
                        ".disable-autohide .custom-select"
                    ),
                    t = 0;
                t < e.length;
                t++
            )
                e[t].addEventListener("click", function (e) {
                    e.stopPropagation();
                });
        },
        carousel: function () {
            !(function (e, t, r) {
                for (var n = 0; n < e.length; n++) t.call(r, n, e[n]);
            })(
                document.querySelectorAll(".cz-carousel .cz-carousel-inner"),
                function (e, t) {
                    var r,
                        n = {
                            container: t,
                            controlsText: [
                                '<i class="czi-arrow-left"></i>',
                                '<i class="czi-arrow-right"></i>',
                            ],
                            navPosition: "bottom",
                            mouseDrag: !0,
                            speed: 500,
                            autoplayHoverPause: !0,
                            autoplayButtonOutput: !1,
                        };
                    null != t.dataset.carouselOptions &&
                        (r = JSON.parse(t.dataset.carouselOptions));
                    var o = _objectSpread(_objectSpread({}, n), r);
                    tns(o);
                }
            );
        },
        gallery: function () {
            var e = document.querySelectorAll(".cz-gallery");
            if (e.length)
                for (var t = 0; t < e.length; t++)
                    lightGallery(e[t], {
                        selector: ".gallery-item",
                        download: !1,
                        videojs: !0,
                        youtubePlayerParams: {
                            modestbranding: 1,
                            showinfo: 0,
                            rel: 0,
                            controls: 0,
                        },
                        vimeoPlayerParams: {
                            byline: 0,
                            portrait: 0,
                            color: "fe696a",
                        },
                    });
        },
        productGallery: function () {
            var s = document.querySelectorAll(".cz-product-gallery");
            if (s.length)
                for (
                    var e = function (r) {
                            for (
                                var n = s[r].querySelectorAll(
                                        ".cz-thumblist-item:not(.video-item)"
                                    ),
                                    o =
                                        s[r].querySelectorAll(
                                            ".cz-preview-item"
                                        ),
                                    e = s[r].querySelectorAll(
                                        ".cz-thumblist-item.video-item"
                                    ),
                                    t = 0;
                                t < n.length;
                                t++
                            )
                                n[t].addEventListener("click", a);

                            function a(e) {
                                e.preventDefault();
                                for (var t = 0; t < n.length; t++)
                                    o[t].classList.remove("active"),
                                        n[t].classList.remove("active");
                                this.classList.add("active"),
                                    s[r]
                                        .querySelector(
                                            this.getAttribute("href")
                                        )
                                        .classList.add("active");
                            }

                            for (var i = 0; i < e.length; i++)
                                lightGallery(e[i], {
                                    selector: "this",
                                    download: !1,
                                    videojs: !0,
                                    youtubePlayerParams: {
                                        modestbranding: 1,
                                        showinfo: 0,
                                        rel: 0,
                                        controls: 0,
                                    },
                                    vimeoPlayerParams: {
                                        byline: 0,
                                        portrait: 0,
                                        color: "fe696a",
                                    },
                                });
                        },
                        t = 0;
                    t < s.length;
                    t++
                )
                    e(t);
        },
        imageZoom: function () {
            let elements = document.querySelectorAll(".cz-image-zoom");
            for (let i = 0; i < elements.length; i++) {
                new Drift(elements[i], {
                    paneContainer: elements[i].parentElement.querySelector(".cz-image-zoom-pane"),
                });
            }
        },
        videoPopupBtn: function () {
            var e = document.querySelectorAll(".video-popup-btn");
            if (e.length)
                for (var t = 0; t < e.length; t++)
                    lightGallery(e[t], {
                        selector: "this",
                        download: !1,
                        videojs: !0,
                        youtubePlayerParams: {
                            modestbranding: 1,
                            showinfo: 0,
                            rel: 0,
                            controls: 0,
                        },
                        vimeoPlayerParams: {
                            byline: 0,
                            portrait: 0,
                            color: "fe696a",
                        },
                    });
        },
        ajaxifySubscribeForm: function () {
            var i = document.querySelectorAll(".cz-subscribe-form");
            if (null !== i) {
                for (
                    var e = function (e) {
                            var t = i[e].querySelector('button[type="submit"]'),
                                r = t.innerHTML,
                                n = i[e].querySelector(".form-control"),
                                o = i[e].querySelector(
                                    ".cz-subscribe-form-antispam"
                                ),
                                a = i[e].querySelector(".subscribe-status");
                            i[e].addEventListener("submit", function (e) {
                                e && e.preventDefault(),
                                    "" === o.value && s(this, t, n, r, a);
                            });
                        },
                        t = 0;
                    t < i.length;
                    t++
                )
                    e(t);
                var s = function (e, t, r, n, o) {
                    t.innerHTML = "Sending...";
                    var a = e.action.replace("/post?", "/post-json?"),
                        i = "&" + r.name + "=" + encodeURIComponent(r.value),
                        s = document.createElement("script");
                    (s.src = a + "&c=callback" + i),
                        document.body.appendChild(s);
                    var c = "callback";
                    window[c] = function (e) {
                        delete window[c],
                            document.body.removeChild(s),
                            (t.innerHTML = n),
                            "success" == e.result
                                ? (r.classList.remove("is-invalid"),
                                  r.classList.add("is-valid"),
                                  o.classList.remove("status-error"),
                                  o.classList.add("status-success"),
                                  (o.innerHTML = e.msg),
                                  setTimeout(function () {
                                      r.classList.remove("is-valid"),
                                          (o.innerHTML = ""),
                                          o.classList.remove("status-success");
                                  }, 6e3))
                                : (r.classList.remove("is-valid"),
                                  r.classList.add("is-invalid"),
                                  o.classList.remove("status-success"),
                                  o.classList.add("status-error"),
                                  (o.innerHTML = e.msg.substring(4)),
                                  setTimeout(function () {
                                      r.classList.remove("is-invalid"),
                                          (o.innerHTML = ""),
                                          o.classList.remove("status-error");
                                  }, 6e3));
                    };
                };
            }
        },
        rangeSlider: function () {
            for (
                var a = document.querySelectorAll(".cz-range-slider"),
                    e = function (e) {
                        var t = a[e].querySelector(".cz-range-slider-ui"),
                            n = a[e].querySelector(
                                ".cz-range-slider-value-min"
                            ),
                            o = a[e].querySelector(
                                ".cz-range-slider-value-max"
                            ),
                            r = {
                                dataStartMin: parseInt(
                                    a[e].dataset.startMin,
                                    10
                                ),
                                dataStartMax: parseInt(
                                    a[e].dataset.startMax,
                                    10
                                ),
                                dataMin: parseInt(a[e].dataset.min, 10),
                                dataMax: parseInt(a[e].dataset.max, 10),
                                dataStep: parseInt(a[e].dataset.step, 10),
                            };
                        noUiSlider.create(t, {
                            start: [r.dataStartMin, r.dataStartMax],
                            connect: !0,
                            step: r.dataStep,
                            pips: { mode: "count", values: 5 },
                            tooltips: !0,
                            range: { min: r.dataMin, max: r.dataMax },
                            format: {
                                to: function (e) {
                                    return "$" + parseInt(e, 10);
                                },
                                from: function (e) {
                                    return Number(e);
                                },
                            },
                        }),
                            t.noUiSlider.on("update", function (e, t) {
                                var r = e[t];
                                (r = r.replace(/\D/g, "")),
                                    t
                                        ? (o.value = Math.round(r))
                                        : (n.value = Math.round(r));
                            }),
                            n.addEventListener("change", function () {
                                t.noUiSlider.set([this.value, null]);
                            }),
                            o.addEventListener("change", function () {
                                t.noUiSlider.set([null, this.value]);
                            });
                    },
                    t = 0;
                t < a.length;
                t++
            )
                e(t);
        },
        filterList: function () {
            for (
                var t = document.querySelectorAll(".cz-filter"),
                    e = function (e) {
                        var r = t[e].querySelector(".cz-filter-search"),
                            n = t[e]
                                .querySelector(".cz-filter-list")
                                .querySelectorAll(".cz-filter-item");
                        if (!r) return "continue";
                        r.addEventListener("keyup", function () {
                            for (
                                var e = r.value.toLowerCase(), t = 0;
                                t < n.length;
                                t++
                            ) {
                                -1 <
                                n[t]
                                    .querySelector(".cz-filter-item-text")
                                    .innerHTML.toLowerCase()
                                    .indexOf(e)
                                    ? n[t].classList.remove("d-none")
                                    : n[t].classList.add("d-none");
                            }
                        });
                    },
                    r = 0;
                r < t.length;
                r++
            )
                e(r);
        },
        dataFilter: function () {
            var e = document.querySelector('[data-filter="trigger"]'),
                n = document.querySelectorAll('[data-filter="target"]');
            null !== e &&
                e.addEventListener("change", function () {
                    var e =
                        this.options[this.selectedIndex].value.toLowerCase();
                    if ("all" === e)
                        for (var t = 0; t < n.length; t++)
                            n[t].classList.remove("d-none");
                    else {
                        for (var r = 0; r < n.length; r++)
                            n[r].classList.add("d-none");
                        document
                            .querySelector("#" + e)
                            .classList.remove("d-none");
                    }
                });
        },
        labelUpdate: function () {
            for (
                var e = document.querySelectorAll("[data-label]"), t = 0;
                t < e.length;
                t++
            )
                e[t].addEventListener("change", function () {
                    var e = this.dataset.label;
                    try {
                        document.getElementById(e).textContent = this.value;
                    } catch (e) {
                        (e.message =
                            "Cannot set property 'textContent' of null"),
                            console.error(
                                "Make sure the [data-label] matches with the id of the target element you want to change text of!"
                            );
                    }
                });
        },
        radioTabs: function () {
            for (
                var e = document.querySelectorAll('[data-toggle="radioTab"]'),
                    t = 0;
                t < e.length;
                t++
            )
                e[t].addEventListener("click", function () {
                    var e = this.dataset.target;
                    document
                        .querySelector(this.dataset.parent)
                        .querySelectorAll(".radio-tab-pane")
                        .forEach(function (e) {
                            e.classList.remove("active");
                        }),
                        document.querySelector(e).classList.add("active");
                });
        },
        countdown: function () {
            var t = document.querySelectorAll(".cz-countdown");
            if (null != t)
                for (
                    var e = function (e) {
                            var r = t[e].dataset.countdown,
                                n = t[e].querySelector(
                                    ".cz-countdown-days .cz-countdown-value"
                                ),
                                o = t[e].querySelector(
                                    ".cz-countdown-hours .cz-countdown-value"
                                ),
                                a = t[e].querySelector(
                                    ".cz-countdown-minutes .cz-countdown-value"
                                ),
                                i = t[e].querySelector(
                                    ".cz-countdown-seconds .cz-countdown-value"
                                ),
                                s = void 0,
                                c = void 0,
                                l = void 0,
                                d = void 0;
                            if (((r = new Date(r).getTime()), isNaN(r)))
                                return { v: void 0 };
                            setInterval(function () {
                                var e = new Date().getTime(),
                                    t = parseInt((r - e) / 1e3);
                                {
                                    if (!(0 <= t)) return;
                                    (s = parseInt(t / 86400)),
                                        (t %= 86400),
                                        (c = parseInt(t / 3600)),
                                        (t %= 3600),
                                        (l = parseInt(t / 60)),
                                        (t %= 60),
                                        (d = parseInt(t)),
                                        null != n &&
                                            (n.innerHTML = parseInt(s, 10)),
                                        null != o &&
                                            (o.innerHTML =
                                                c < 10 ? "0" + c : c),
                                        null != a &&
                                            (a.innerHTML =
                                                l < 10 ? "0" + l : l),
                                        null != i &&
                                            (i.innerHTML =
                                                d < 10 ? "0" + d : d);
                                }
                            }, 1e3);
                        },
                        r = 0;
                    r < t.length;
                    r++
                ) {
                    var n = e(r);
                    if ("object" === _typeof(n)) return n.v;
                }
        },
        creditCard: function () {
            var e = document.querySelector(".interactive-credit-card");
            if (null !== e) new Card({ form: e, container: ".card-wrapper" });
        },
        charts: function () {
            function a(e, t) {
                return e + t;
            }

            var e = document.querySelectorAll("[data-line-chart]"),
                t = document.querySelectorAll("[data-bar-chart]"),
                i = document.querySelectorAll("[data-pie-chart]");
            if (0 !== e.length || 0 !== t.length || 0 !== i.length) {
                var s,
                    r =
                        document.head ||
                        document.getElementsByTagName("head")[0],
                    c = document.createElement("style");
                r.appendChild(c);
                for (var n = 0; n < e.length; n++) {
                    var o = JSON.parse(e[n].dataset.lineChart),
                        l =
                            null != e[n].dataset.options
                                ? JSON.parse(e[n].dataset.options)
                                : "",
                        d = e[n].dataset.seriesColor,
                        u = void 0;
                    if ((e[n].classList.add("cz-line-chart-" + n), null != d)) {
                        u = JSON.parse(d);
                        for (var f = 0; f < u.colors.length; f++)
                            (s = "\n              .cz-line-chart-"
                                .concat(n, " .ct-series:nth-child(")
                                .concat(
                                    f + 1,
                                    ") .ct-line,\n              .cz-line-chart-"
                                )
                                .concat(n, " .ct-series:nth-child(")
                                .concat(
                                    f + 1,
                                    ") .ct-point {\n                stroke: "
                                )
                                .concat(
                                    u.colors[f],
                                    " !important;\n              }\n            "
                                )),
                                c.appendChild(document.createTextNode(s));
                    }
                    new Chartist.Line(e[n], o, l);
                }
                for (var v = 0; v < t.length; v++) {
                    var p = JSON.parse(t[v].dataset.barChart),
                        m =
                            null != t[v].dataset.options
                                ? JSON.parse(t[v].dataset.options)
                                : "",
                        g = t[v].dataset.seriesColor,
                        h = void 0;
                    if ((t[v].classList.add("cz-bar-chart-" + v), null != g)) {
                        h = JSON.parse(g);
                        for (var y = 0; y < h.colors.length; y++)
                            (s = "\n            .cz-bar-chart-"
                                .concat(v, " .ct-series:nth-child(")
                                .concat(
                                    y + 1,
                                    ") .ct-bar {\n                stroke: "
                                )
                                .concat(
                                    h.colors[y],
                                    " !important;\n              }\n            "
                                )),
                                c.appendChild(document.createTextNode(s));
                    }
                    new Chartist.Bar(t[v], p, m);
                }
                for (
                    var b = function (e) {
                            var t = JSON.parse(i[e].dataset.pieChart),
                                r = i[e].dataset.seriesColor,
                                n = void 0;
                            if (
                                (i[e].classList.add("cz-pie-chart-" + e),
                                null != r)
                            ) {
                                n = JSON.parse(r);
                                for (var o = 0; o < n.colors.length; o++)
                                    (s = "\n            .cz-pie-chart-"
                                        .concat(e, " .ct-series:nth-child(")
                                        .concat(
                                            o + 1,
                                            ") .ct-slice-pie {\n                fill: "
                                        )
                                        .concat(
                                            n.colors[o],
                                            " !important;\n              }\n            "
                                        )),
                                        c.appendChild(
                                            document.createTextNode(s)
                                        );
                            }
                            new Chartist.Pie(i[e], t, {
                                labelInterpolationFnc: function (e) {
                                    return (
                                        Math.round(
                                            (e / t.series.reduce(a)) * 100
                                        ) + "%"
                                    );
                                },
                            });
                        },
                        S = 0;
                    S < i.length;
                    S++
                )
                    b(S);
            }
        },
    };
    e.init();

    /*==================================
     Verify Counter
     ====================================*/
    function countdown() {
        var counter = $(".verifyCounter");
        var seconds = counter.data("second");
        function tick() {
            var m = Math.floor(seconds / 60);
            var s = seconds % 60;
            seconds--;
            counter.html(m + ":" + (s < 10 ? "0" : "") + String(s));
            if (seconds > 0) {
                setTimeout(tick, 1000);
                $(".resend-otp-button").attr("disabled", true);
                $(".resend_otp_custom").slideDown();
            } else {
                $(".resend-otp-button").removeAttr("disabled");
                $(".verifyCounter").html("0:00");
                $(".resend_otp_custom").slideUp();
            }
        }
        tick();
    }
    countdown();
})(jQuery);
