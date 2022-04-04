var OSFPerformance;
(function (OSFPerformance) {
    OSFPerformance.officeExecuteStartDate = 0;
    OSFPerformance.officeExecuteStart = 0;
    OSFPerformance.officeExecuteEnd = 0;
    OSFPerformance.hostInitializationStart = 0;
    OSFPerformance.hostInitializationEnd = 0;
    OSFPerformance.totalJSHeapSize = 0;
    OSFPerformance.usedJSHeapSize = 0;
    OSFPerformance.jsHeapSizeLimit = 0;
    OSFPerformance.getAppContextStart = 0;
    OSFPerformance.getAppContextEnd = 0;
    OSFPerformance.createOMEnd = 0;
    OSFPerformance.officeOnReady = 0;
    OSFPerformance.hostSpecificFileName = "";

    function now() {
        if (performance && performance.now) {
            return performance.now();
        } else {
            return 0;
        }
    }
    OSFPerformance.now = now;

    function getTotalJSHeapSize() {
        if (typeof (performance) !== 'undefined' && performance.memory) {
            return performance.memory.totalJSHeapSize;
        } else {
            return 0;
        }
    }
    OSFPerformance.getTotalJSHeapSize = getTotalJSHeapSize;

    function getUsedJSHeapSize() {
        if (typeof (performance) !== 'undefined' && performance.memory) {
            return performance.memory.usedJSHeapSize;
        } else {
            return 0;
        }
    }
    OSFPerformance.getUsedJSHeapSize = getUsedJSHeapSize;

    function getJSHeapSizeLimit() {
        if (typeof (performance) !== 'undefined' && performance.memory) {
            return performance.memory.jsHeapSizeLimit;
        } else {
            return 0;
        }
    }
    OSFPerformance.getJSHeapSizeLimit = getJSHeapSizeLimit;
})(OSFPerformance || (OSFPerformance = {}));;
OSFPerformance.officeExecuteStartDate = Date.now();
OSFPerformance.officeExecuteStart = OSFPerformance.now();



/* Office JavaScript API library */

/*
	Copyright (c) Microsoft Corporation.  All rights reserved.
*/


/*
    Your use of this file is governed by the Microsoft Services Agreement http://go.microsoft.com/fwlink/?LinkId=266419.

    This file also contains the following Promise implementation (with a few small modifications):
        * @overview es6-promise - a tiny implementation of Promises/A+.
        * @copyright Copyright (c) 2014 Yehuda Katz, Tom Dale, Stefan Penner and contributors (Conversion to ES6 API by Jake Archibald)
        * @license   Licensed under MIT license
        *            See https://raw.githubusercontent.com/jakearchibald/es6-promise/master/LICENSE
        * @version   2.3.0
*/
var OSF = OSF || {};
OSF.HostSpecificFileVersionDefault = "16.00";
OSF.HostSpecificFileVersionMap = {
    access: {
        web: "16.00"
    },
    agavito: {
        winrt: "16.00"
    },
    excel: {
        ios: "16.00",
        mac: "16.00",
        web: "16.00",
        win32: "16.01",
        winrt: "16.00"
    },
    onenote: {
        android: "16.00",
        web: "16.00",
        win32: "16.00",
        winrt: "16.00"
    },
    outlook: {
        ios: "16.00",
        mac: "16.00",
        web: "16.01",
        win32: "16.02"
    },
    powerpoint: {
        ios: "16.00",
        mac: "16.00",
        web: "16.00",
        win32: "16.01",
        winrt: "16.00"
    },
    project: {
        win32: "16.00"
    },
    sway: {
        web: "16.00"
    },
    word: {
        ios: "16.00",
        mac: "16.00",
        web: "16.00",
        win32: "16.01",
        winrt: "16.00"
    },
    visio: {
        web: "16.00",
        win32: "16.00"
    }
};
OSF.SupportedLocales = {
    "ar-sa": true,
    "bg-bg": true,
    "bn-in": true,
    "ca-es": true,
    "cs-cz": true,
    "da-dk": true,
    "de-de": true,
    "el-gr": true,
    "en-us": true,
    "es-es": true,
    "et-ee": true,
    "eu-es": true,
    "fa-ir": true,
    "fi-fi": true,
    "fr-fr": true,
    "gl-es": true,
    "he-il": true,
    "hi-in": true,
    "hr-hr": true,
    "hu-hu": true,
    "id-id": true,
    "it-it": true,
    "ja-jp": true,
    "kk-kz": true,
    "ko-kr": true,
    "lo-la": true,
    "lt-lt": true,
    "lv-lv": true,
    "ms-my": true,
    "nb-no": true,
    "nl-nl": true,
    "nn-no": true,
    "pl-pl": true,
    "pt-br": true,
    "pt-pt": true,
    "ro-ro": true,
    "ru-ru": true,
    "sk-sk": true,
    "sl-si": true,
    "sr-cyrl-cs": true,
    "sr-cyrl-rs": true,
    "sr-latn-cs": true,
    "sr-latn-rs": true,
    "sv-se": true,
    "th-th": true,
    "tr-tr": true,
    "uk-ua": true,
    "ur-pk": true,
    "vi-vn": true,
    "zh-cn": true,
    "zh-tw": true
};
OSF.AssociatedLocales = {
    ar: "ar-sa",
    bg: "bg-bg",
    bn: "bn-in",
    ca: "ca-es",
    cs: "cs-cz",
    da: "da-dk",
    de: "de-de",
    el: "el-gr",
    en: "en-us",
    es: "es-es",
    et: "et-ee",
    eu: "eu-es",
    fa: "fa-ir",
    fi: "fi-fi",
    fr: "fr-fr",
    gl: "gl-es",
    he: "he-il",
    hi: "hi-in",
    hr: "hr-hr",
    hu: "hu-hu",
    id: "id-id",
    it: "it-it",
    ja: "ja-jp",
    kk: "kk-kz",
    ko: "ko-kr",
    lo: "lo-la",
    lt: "lt-lt",
    lv: "lv-lv",
    ms: "ms-my",
    nb: "nb-no",
    nl: "nl-nl",
    nn: "nn-no",
    pl: "pl-pl",
    pt: "pt-br",
    ro: "ro-ro",
    ru: "ru-ru",
    sk: "sk-sk",
    sl: "sl-si",
    sr: "sr-cyrl-cs",
    sv: "sv-se",
    th: "th-th",
    tr: "tr-tr",
    uk: "uk-ua",
    ur: "ur-pk",
    vi: "vi-vn",
    zh: "zh-cn"
};
OSF.getSupportedLocale = function (a, c) {
    if (c === void 0) c = "en-us";
    if (!a) return c;
    var b;
    a = a.toLowerCase();
    if (a in OSF.SupportedLocales) b = a;
    else {
        var d = a.split("-", 1);
        if (d && d.length > 0) b = OSF.AssociatedLocales[d[0]]
    }
    if (!b) b = c;
    return b
};
var ScriptLoading;
(function (e) {
    var a = false,
        b = function () {
            function b(g, e, d, f, c) {
                var b = this;
                b.url = g;
                b.isReady = e;
                b.hasStarted = d;
                b.timer = f;
                b.hasError = a;
                b.pendingCallbacks = [];
                b.pendingCallbacks.push(c)
            }
            return b
        }(),
        d = function () {
            function a(c, b, a) {
                this.scriptId = c;
                this.startTime = b;
                this.msResponseTime = a
            }
            return a
        }(),
        c = function () {
            var c = true,
                e = null;

            function f(b) {
                var a = this;
                if (b === void 0) b = {
                    OfficeJS: "office.js",
                    OfficeDebugJS: "office.debug.js"
                };
                a.constantNames = b;
                a.defaultScriptLoadingTimeout = 1e4;
                a.loadedScriptByIds = {};
                a.scriptTelemetryBuffer = [];
                a.osfControlAppCorrelationId = "";
                a.basePath = e
            }
            f.prototype.isScriptLoading = function (a) {
                return !!(this.loadedScriptByIds[a] && this.loadedScriptByIds[a].hasStarted)
            };
            f.prototype.getOfficeJsBasePath = function () {
                var a = this;
                if (a.basePath) return a.basePath;
                else {
                    for (var g = function (b, c) {
                            var d, a, e;
                            e = b.toLowerCase();
                            a = e.indexOf(c);
                            if (a >= 0 && a === b.length - c.length && (a === 0 || b.charAt(a - 1) === "/" || b.charAt(a - 1) === "\\")) d = b.substring(0, a);
                            else if (a >= 0 && a < b.length - c.length && b.charAt(a + c.length) === "?" && (a === 0 || b.charAt(a - 1) === "/" || b.charAt(a - 1) === "\\")) d = b.substring(0, a);
                            return d
                        }, d = document.getElementsByTagName("script"), h = d.length, e = [a.constantNames.OfficeJS, a.constantNames.OfficeDebugJS], f = e.length, c, b = 0; !a.basePath && b < h; b++)
                        if (d[b].src)
                            for (c = 0; !a.basePath && c < f; c++) a.basePath = g(d[b].src, e[c]);
                    return a.basePath
                }
            };
            f.prototype.loadScript = function (e, d, c, a, b) {
                this.loadScriptInternal(e, d, c, a, b)
            };
            f.prototype.loadScriptParallel = function (d, c, b) {
                this.loadScriptInternal(d, c, e, a, b)
            };
            f.prototype.waitForFunction = function (g, e, h, i) {
                var b = h,
                    f, d = function () {
                        b--;
                        if (g()) {
                            e(c);
                            return
                        } else if (b > 0) {
                            f = window.setTimeout(d, i);
                            b--
                        } else {
                            window.clearTimeout(f);
                            e(a)
                        }
                    };
                d()
            };
            f.prototype.waitForScripts = function (b, e) {
                var f = this;
                if (this.invokeCallbackIfScriptsReady(b, e) == a)
                    for (var c = 0; c < b.length; c++) {
                        var g = b[c],
                            d = this.loadedScriptByIds[g];
                        d && d.pendingCallbacks.push(function () {
                            f.invokeCallbackIfScriptsReady(b, e)
                        })
                    }
            };
            f.prototype.logScriptLoading = function (c, a, b) {
                a = Math.floor(a);
                if (OSF.AppTelemetry && OSF.AppTelemetry.onScriptDone)
                    if (OSF.AppTelemetry.onScriptDone.length == 3) OSF.AppTelemetry.onScriptDone(c, a, b);
                    else OSF.AppTelemetry.onScriptDone(c, a, b, this.osfControlAppCorrelationId);
                else {
                    var e = new d(c, a, b);
                    this.scriptTelemetryBuffer.push(e)
                }
            };
            f.prototype.setAppCorrelationId = function (a) {
                this.osfControlAppCorrelationId = a
            };
            f.prototype.invokeCallbackIfScriptsReady = function (h, j) {
                for (var g = a, f = 0; f < h.length; f++) {
                    var i = h[f],
                        d = this.loadedScriptByIds[i];
                    if (!d) {
                        d = new b("", a, a, e, e);
                        this.loadedScriptByIds[i] = d
                    }
                    if (d.isReady == a) return a;
                    else if (d.hasError) g = c
                }
                j(!g);
                return c
            };
            f.prototype.getScriptEntryByUrl = function (c) {
                for (var b in this.loadedScriptByIds) {
                    var a = this.loadedScriptByIds[b];
                    if (this.loadedScriptByIds.hasOwnProperty(b) && a.url === c) return a
                }
                return e
            };
            f.prototype.loadScriptInternal = function (h, g, i, n, k) {
                var j = this;
                if (h) {
                    var q = j,
                        r = window.document,
                        d = g && j.loadedScriptByIds[g] ? j.loadedScriptByIds[g] : j.getScriptEntryByUrl(h);
                    if (!d || d.hasError || d.url.toLowerCase() != h.toLowerCase()) {
                        var f = r.createElement("script");
                        f.type = "text/javascript";
                        if (g) f.id = g;
                        if (!d) {
                            d = new b(h, a, a, e, e);
                            j.loadedScriptByIds[g ? g : h] = d
                        } else {
                            d.url = h;
                            d.hasError = a;
                            d.isReady = a
                        }
                        if (i)
                            if (n) d.pendingCallbacks.unshift(i);
                            else d.pendingCallbacks.push(i);
                        var l = -1;
                        if (window.performance && window.performance.now) l = window.performance.now();
                        var s = (new Date).getTime(),
                            o = function (b) {
                                if (g) {
                                    var a = (new Date).getTime() - s;
                                    if (!b) a = -a;
                                    q.logScriptLoading(g, l, a)
                                }
                                q.flushTelemetryBuffer()
                            },
                            m = function () {
                                if (!OSF._OfficeAppFactory.getLoggingAllowed() && typeof OSF.AppTelemetry !== "undefined") OSF.AppTelemetry.enableTelemetry = a;
                                o(c);
                                d.isReady = c;
                                if (d.timer != e) {
                                    clearTimeout(d.timer);
                                    delete d.timer
                                }
                                for (var g = d.pendingCallbacks.length, f = 0; f < g; f++) {
                                    var b = d.pendingCallbacks.shift();
                                    if (b) {
                                        var h = b(c);
                                        if (h === a) break
                                    }
                                }
                            },
                            p = function () {
                                o(a);
                                d.hasError = c;
                                d.isReady = c;
                                if (d.timer != e) {
                                    clearTimeout(d.timer);
                                    delete d.timer
                                }
                                for (var g = d.pendingCallbacks.length, f = 0; f < g; f++) {
                                    var b = d.pendingCallbacks.shift();
                                    if (b) {
                                        var h = b(a);
                                        if (h === a) break
                                    }
                                }
                            };
                        if (f.readyState) f.onreadystatechange = function () {
                            if (f.readyState == "loaded" || f.readyState == "complete") {
                                f.onreadystatechange = e;
                                m()
                            }
                        };
                        else f.onload = m;
                        f.onerror = p;
                        k = k || j.defaultScriptLoadingTimeout;
                        d.timer = setTimeout(p, k);
                        d.hasStarted = c;
                        f.setAttribute("crossOrigin", "anonymous");
                        f.src = h;
                        r.getElementsByTagName("head")[0].appendChild(f)
                    } else if (d.isReady) i(c);
                    else if (n) d.pendingCallbacks.unshift(i);
                    else d.pendingCallbacks.push(i)
                }
            };
            f.prototype.flushTelemetryBuffer = function () {
                var b = this;
                if (OSF.AppTelemetry && OSF.AppTelemetry.onScriptDone) {
                    for (var c = 0; c < b.scriptTelemetryBuffer.length; c++) {
                        var a = b.scriptTelemetryBuffer[c];
                        if (OSF.AppTelemetry.onScriptDone.length == 3) OSF.AppTelemetry.onScriptDone(a.scriptId, a.startTime, a.msResponseTime);
                        else OSF.AppTelemetry.onScriptDone(a.scriptId, a.startTime, a.msResponseTime, b.osfControlAppCorrelationId)
                    }
                    b.scriptTelemetryBuffer = []
                }
            };
            return f
        }();
    e.LoadScriptHelper = c
})(ScriptLoading || (ScriptLoading = {}));
var OfficeExt;
(function (a) {
    var b;
    (function (a) {
        var b = function () {
            function a() {
                var a = this;
                a.getDiagnostics = function (b) {
                    var a = {
                        host: this.getHost(),
                        version: b || this.getDefaultVersion(),
                        platform: this.getPlatform()
                    };
                    return a
                };
                a.platformRemappings = {
                    web: Microsoft.Office.WebExtension.PlatformType.OfficeOnline,
                    winrt: Microsoft.Office.WebExtension.PlatformType.Universal,
                    win32: Microsoft.Office.WebExtension.PlatformType.PC,
                    mac: Microsoft.Office.WebExtension.PlatformType.Mac,
                    ios: Microsoft.Office.WebExtension.PlatformType.iOS,
                    android: Microsoft.Office.WebExtension.PlatformType.Android
                };
                a.camelCaseMappings = {
                    powerpoint: Microsoft.Office.WebExtension.HostType.PowerPoint,
                    onenote: Microsoft.Office.WebExtension.HostType.OneNote
                };
                a.hostInfo = OSF._OfficeAppFactory.getHostInfo();
                a.getHost = a.getHost.bind(a);
                a.getPlatform = a.getPlatform.bind(a);
                a.getDiagnostics = a.getDiagnostics.bind(a)
            }
            a.prototype.capitalizeFirstLetter = function (a) {
                if (a) return a[0].toUpperCase() + a.slice(1).toLowerCase();
                return a
            };
            a.getInstance = function () {
                if (a.hostObj === undefined) a.hostObj = new a;
                return a.hostObj
            };
            a.prototype.getPlatform = function () {
                var a = this;
                if (a.hostInfo.hostPlatform) {
                    var b = a.hostInfo.hostPlatform.toLowerCase();
                    if (a.platformRemappings[b]) return a.platformRemappings[b]
                }
                return null
            };
            a.prototype.getHost = function () {
                var a = this;
                if (a.hostInfo.hostType) {
                    var b = a.hostInfo.hostType.toLowerCase();
                    if (a.camelCaseMappings[b]) return a.camelCaseMappings[b];
                    b = a.capitalizeFirstLetter(a.hostInfo.hostType);
                    if (Microsoft.Office.WebExtension.HostType[b]) return Microsoft.Office.WebExtension.HostType[b]
                }
                return null
            };
            a.prototype.getDefaultVersion = function () {
                if (this.getHost()) return "16.0.0000.0000";
                return null
            };
            return a
        }();
        a.Host = b
    })(b = a.HostName || (a.HostName = {}))
})(OfficeExt || (OfficeExt = {}));
var Office;
(function (d) {
    var a = true,
        b = "undefined",
        c = "function",
        e;
    (function (d) {
        var e;
        (function (d) {
            function e() {
                return function () {
                    var d = null,
                        e = "object";
                    "use strict";

                    function Q(a) {
                        return typeof a === c || typeof a === e && a !== d
                    }

                    function y(a) {
                        return typeof a === c
                    }

                    function T(a) {
                        return typeof a === e && a !== d
                    }
                    var z;
                    if (!Array.isArray) z = function (a) {
                        return Object.prototype.toString.call(a) === "[object Array]"
                    };
                    else z = Array.isArray;
                    var D = z,
                        r = 0,
                        pb = {}.toString,
                        jb, w, l = function (a, b) {
                            q[r] = a;
                            q[r + 1] = b;
                            r += 2;
                            if (r === 2)
                                if (w) w(p);
                                else u()
                        };

                    function cb(a) {
                        w = a
                    }

                    function lb(a) {
                        l = a
                    }
                    var X = typeof window !== b ? window : undefined,
                        C = X || {},
                        G = C.MutationObserver || C.WebKitMutationObserver,
                        mb = typeof process !== b && {}.toString.call(process) === "[object process]",
                        kb = typeof Uint8ClampedArray !== b && typeof importScripts !== b && typeof MessageChannel !== b;

                    function eb() {
                        var b = process.nextTick,
                            a = process.versions.node.match(/^(?:(\d+)\.)?(?:(\d+)\.)?(\*|\d+)$/);
                        if (Array.isArray(a) && a[1] === "0" && a[2] === "10") b = setImmediate;
                        return function () {
                            b(p)
                        }
                    }

                    function O() {
                        var a = new MessageChannel;
                        a.port1.onmessage = p;
                        return function () {
                            a.port2.postMessage(0)
                        }
                    }

                    function Y() {
                        return function () {
                            setTimeout(p, 1)
                        }
                    }
                    var q = new Array(1e3);

                    function p() {
                        for (var a = 0; a < r; a += 2) {
                            var b = q[a],
                                c = q[a + 1];
                            b(c);
                            q[a] = undefined;
                            q[a + 1] = undefined
                        }
                        r = 0
                    }
                    var u;
                    if (mb) u = eb();
                    else if (kb) u = O();
                    else u = Y();

                    function o() {}
                    var k = void 0,
                        m = 1,
                        j = 2,
                        s = new B;

                    function K() {
                        return new TypeError("You cannot resolve a promise with itself")
                    }

                    function L() {
                        return new TypeError("A promises callback cannot return that same promise.")
                    }

                    function ab(b) {
                        try {
                            return b.then
                        } catch (a) {
                            s.error = a;
                            return s
                        }
                    }

                    function bb(e, d, b, c) {
                        try {
                            e.call(d, b, c)
                        } catch (a) {
                            return a
                        }
                    }

                    function E(c, b, d) {
                        l(function (e) {
                            var c = false,
                                g = bb(d, b, function (d) {
                                    if (c) return;
                                    c = a;
                                    if (b !== d) n(e, d);
                                    else h(e, d)
                                }, function (b) {
                                    if (c) return;
                                    c = a;
                                    f(e, b)
                                }, "Settle: " + (e._label || " unknown promise"));
                            if (!c && g) {
                                c = a;
                                f(e, g)
                            }
                        }, c)
                    }

                    function H(b, a) {
                        if (a._state === m) h(b, a._result);
                        else if (a._state === j) f(b, a._result);
                        else t(a, undefined, function (a) {
                            n(b, a)
                        }, function (a) {
                            f(b, a)
                        })
                    }

                    function F(b, a) {
                        if (a.constructor === b.constructor) H(b, a);
                        else {
                            var c = ab(a);
                            if (c === s) f(b, s.error);
                            else if (c === undefined) h(b, a);
                            else if (y(c)) E(b, a, c);
                            else h(b, a)
                        }
                    }

                    function n(a, b) {
                        if (a === b) f(a, K());
                        else if (Q(b)) F(a, b);
                        else h(a, b)
                    }

                    function J(a) {
                        a._onerror && a._onerror(a._result);
                        x(a)
                    }

                    function h(a, b) {
                        if (a._state !== k) return;
                        a._result = b;
                        a._state = m;
                        a._subscribers.length !== 0 && l(x, a)
                    }

                    function f(a, b) {
                        if (a._state !== k) return;
                        a._state = j;
                        a._result = b;
                        l(J, a)
                    }

                    function t(c, g, e, f) {
                        var a = c._subscribers,
                            b = a.length;
                        c._onerror = d;
                        a[b] = g;
                        a[b + m] = e;
                        a[b + j] = f;
                        b === 0 && c._state && l(x, c)
                    }

                    function x(b) {
                        var a = b._subscribers,
                            f = b._state;
                        if (a.length === 0) return;
                        for (var e, d, g = b._result, c = 0; c < a.length; c += 3) {
                            e = a[c];
                            d = a[c + f];
                            if (e) A(f, e, d, g);
                            else d(g)
                        }
                        b._subscribers.length = 0
                    }

                    function B() {
                        this.error = d
                    }
                    var v = new B;

                    function W(b, c) {
                        try {
                            return b(c)
                        } catch (a) {
                            v.error = a;
                            return v
                        }
                    }

                    function A(l, c, i, o) {
                        var g = y(i),
                            b, q, e, p;
                        if (g) {
                            b = W(i, o);
                            if (b === v) {
                                p = a;
                                q = b.error;
                                b = d
                            } else e = a;
                            if (c === b) {
                                f(c, L());
                                return
                            }
                        } else {
                            b = o;
                            e = a
                        }
                        if (c._state === k)
                            if (g && e) n(c, b);
                            else if (p) f(c, q);
                        else if (l === m) h(c, b);
                        else l === j && f(c, b)
                    }

                    function I(a, c) {
                        try {
                            c(function (b) {
                                n(a, b)
                            }, function (b) {
                                f(a, b)
                            })
                        } catch (b) {
                            f(a, b)
                        }
                    }

                    function i(c, b) {
                        var a = this;
                        a._instanceConstructor = c;
                        a.promise = new c(o);
                        if (a._validateInput(b)) {
                            a._input = b;
                            a.length = b.length;
                            a._remaining = b.length;
                            a._init();
                            if (a.length === 0) h(a.promise, a._result);
                            else {
                                a.length = a.length || 0;
                                a._enumerate();
                                a._remaining === 0 && h(a.promise, a._result)
                            }
                        } else f(a.promise, a._validationError())
                    }
                    i.prototype._validateInput = function (a) {
                        return D(a)
                    };
                    i.prototype._validationError = function () {
                        return new Error("Array Methods must be provided an Array")
                    };
                    i.prototype._init = function () {
                        this._result = new Array(this.length)
                    };
                    var Z = i;
                    i.prototype._enumerate = function () {
                        for (var a = this, d = a.length, c = a.promise, e = a._input, b = 0; c._state === k && b < d; b++) a._eachEntry(e[b], b)
                    };
                    i.prototype._eachEntry = function (a, c) {
                        var b = this,
                            e = b._instanceConstructor;
                        if (T(a))
                            if (a.constructor === e && a._state !== k) {
                                a._onerror = d;
                                b._settledAt(a._state, c, a._result)
                            } else b._willSettleAt(e.resolve(a), c);
                        else {
                            b._remaining--;
                            b._result[c] = a
                        }
                    };
                    i.prototype._settledAt = function (d, e, c) {
                        var a = this,
                            b = a.promise;
                        if (b._state === k) {
                            a._remaining--;
                            if (d === j) f(b, c);
                            else a._result[e] = c
                        }
                        a._remaining === 0 && h(b, a._result)
                    };
                    i.prototype._willSettleAt = function (c, b) {
                        var a = this;
                        t(c, undefined, function (c) {
                            a._settledAt(m, b, c)
                        }, function (c) {
                            a._settledAt(j, b, c)
                        })
                    };

                    function ib(a) {
                        return (new Z(this, a)).promise
                    }
                    var V = ib;

                    function db(b) {
                        var d = this,
                            a = new d(o);
                        if (!D(b)) {
                            f(a, new TypeError("You must pass an array to race."));
                            return a
                        }
                        var h = b.length;

                        function e(b) {
                            n(a, b)
                        }

                        function g(b) {
                            f(a, b)
                        }
                        for (var c = 0; a._state === k && c < h; c++) t(d.resolve(b[c]), undefined, e, g);
                        return a
                    }
                    var U = db;

                    function N(a) {
                        var b = this;
                        if (a && typeof a === e && a.constructor === b) return a;
                        var c = new b(o);
                        n(c, a);
                        return c
                    }
                    var M = N;

                    function S(c) {
                        var b = this,
                            a = new b(o);
                        f(a, c);
                        return a
                    }
                    var P = S,
                        gb = 0;

                    function R() {
                        throw new TypeError("You must pass a resolver function as the first argument to the promise constructor")
                    }

                    function fb() {
                        throw new TypeError("Failed to construct 'Promise': Please use the 'new' operator, this object constructor cannot be called as a function.")
                    }
                    var hb = g;

                    function g(b) {
                        var a = this;
                        a._id = gb++;
                        a._state = undefined;
                        a._result = undefined;
                        a._subscribers = [];
                        if (o !== b) {
                            !y(b) && R();
                            !(a instanceof g) && fb();
                            I(a, b)
                        }
                    }
                    g.all = V;
                    g.race = U;
                    g.resolve = M;
                    g.reject = P;
                    g._setScheduler = cb;
                    g._setAsap = lb;
                    g._asap = l;
                    g.prototype = {
                        constructor: g,
                        then: function (d, e) {
                            var b = this,
                                a = b._state;
                            if (a === m && !d || a === j && !e) return this;
                            var c = new this.constructor(o),
                                g = b._result;
                            if (a) {
                                var f = arguments[a - 1];
                                l(function () {
                                    A(a, c, f, g)
                                })
                            } else t(b, c, d, e);
                            return c
                        },
                        "catch": function (a) {
                            return this.then(d, a)
                        }
                    };
                    return hb
                }.call(this)
            }
            d.Init = e
        })(e = d.PromiseImpl || (d.PromiseImpl = {}))
    })(e = d._Internal || (d._Internal = {}));
    (function (d) {
        function f() {
            var b = window.navigator.userAgent,
                c = b.indexOf("Edge/");
            if (c >= 0) {
                b = b.substring(c + 5, b.length);
                if (b < "14.14393") return a;
                else return false
            }
            return false
        }

        function e() {
            if (typeof window === b && typeof Promise === c) return Promise;
            if (typeof window !== b && window.Promise)
                if (f()) return d.PromiseImpl.Init();
                else return window.Promise;
            else return d.PromiseImpl.Init()
        }
        d.OfficePromise = e()
    })(e = d._Internal || (d._Internal = {}));
    var f = e.OfficePromise;
    d.Promise = f
})(Office || (Office = {}));
var OTel;
(function (c) {
    var a = "telemetry/oteljs_agave.js",
        b = function () {
            var c = "undefined";

            function b() {}
            b.loaded = function () {
                return !(b.logger === undefined || b.sink === undefined)
            };
            b.getOtelSinkCDNLocation = function () {
                return OSF._OfficeAppFactory.getLoadScriptHelper().getOfficeJsBasePath() + a
            };
            b.getMapName = function (b, a) {
                if (a !== undefined && b.hasOwnProperty(a)) return b[a];
                return a
            };
            b.getHost = function () {
                var c = OSF._OfficeAppFactory.getHostInfo()["hostType"],
                    d = {
                        excel: "Excel",
                        onenote: "OneNote",
                        outlook: "Outlook",
                        powerpoint: "PowerPoint",
                        project: "Project",
                        visio: "Visio",
                        word: "Word"
                    },
                    a = b.getMapName(d, c);
                return a
            };
            b.getFlavor = function () {
                var c = OSF._OfficeAppFactory.getHostInfo()["hostPlatform"],
                    d = {
                        android: "Android",
                        ios: "iOS",
                        mac: "Mac",
                        universal: "Universal",
                        web: "Web",
                        win32: "Win32"
                    },
                    a = b.getMapName(d, c);
                return a
            };
            b.ensureValue = function (a, b) {
                if (!a) return b;
                return a
            };
            b.create = function (a) {
                var i = {
                        id: a.appId,
                        marketplaceType: a.marketplaceType,
                        assetId: a.assetId,
                        officeJsVersion: a.officeJSVersion,
                        hostJsVersion: a.hostJSVersion,
                        browserToken: a.clientId,
                        instanceId: a.appInstanceId,
                        sessionId: a.sessionId
                    },
                    k = oteljs.Contracts.Office.System.SDX.getFields("SDX", i),
                    l = b.getHost(),
                    e = b.getFlavor(),
                    j = e === "Web" && a.hostVersion.slice(0, 2) === "0." ? "16.0.0.0" : a.hostVersion,
                    d = {
                        "App.Name": l,
                        "App.Platform": e,
                        "App.Version": j,
                        "Session.Id": b.ensureValue(a.correlationId, "00000000-0000-0000-0000-000000000000")
                    },
                    h = "Office.Extensibility.OfficeJs",
                    g = "db334b301e7b474db5e0f02f07c51a47-a1b5bc36-1bbe-482f-a64a-c2d9cb606706-7439",
                    f = 1755,
                    c = new oteljs.SimpleTelemetryLogger(undefined, k);
                c.setTenantToken(h, g, f);
                if (oteljs.AgaveSink) b.sink = oteljs.AgaveSink.createInstance(d);
                if (b.sink === undefined) b.attachLegacyAgaveSink(d);
                else c.addSink(b.sink);
                return c
            };
            b.attachLegacyAgaveSink = function (e) {
                var d = function () {
                        if (typeof oteljs_agave !== c) b.sink = oteljs_agave.AgaveSink.createInstance(e);
                        if (b.sink === undefined || b.logger === undefined) {
                            b.Enabled = false;
                            b.promises = [];
                            b.logger = undefined;
                            b.sink = undefined;
                            return
                        }
                        b.logger.addSink(b.sink);
                        b.promises.forEach(function (a) {
                            a()
                        })
                    },
                    a = 5e3;
                OSF.OUtil.loadScript(b.getOtelSinkCDNLocation(), d, a)
            };
            b.initialize = function (d) {
                if (!b.Enabled) {
                    b.promises = [];
                    return
                }
                var a = function () {
                    if (typeof oteljs === c) return;
                    if (!b.loaded()) b.logger = b.create(d);
                    b.loaded() && b.promises.forEach(function (a) {
                        a()
                    })
                };
                Microsoft.Office.WebExtension.onReadyInternal().then(function () {
                    return a()
                })
            };
            b.sendTelemetryEvent = function (a) {
                b.onTelemetryLoaded(function () {
                    try {
                        b.logger.sendTelemetryEvent(a)
                    } catch (c) {}
                })
            };
            b.sendCustomerContent = function (a) {
                b.onTelemetryLoaded(function () {
                    try {
                        b.logger.sendCustomerContent(a)
                    } catch (c) {}
                })
            };
            b.onTelemetryLoaded = function (a) {
                if (!b.Enabled) return;
                if (b.loaded()) a();
                else b.promises.push(a)
            };
            b.promises = [];
            b.Enabled = true;
            return b
        }();
    c.OTelLogger = b
})(OTel || (OTel = {}));
(function (b) {
    var a = function () {
        function a() {
            this.m_mappings = {};
            this.m_onchangeHandlers = []
        }
        a.prototype.associate = function () {
            var a = "[InvalidArg] Function=associate",
                b = this;

            function c(a) {
                typeof console !== "undefined" && console.warn && console.warn(a)
            }
            if (arguments.length == 1 && typeof arguments[0] === "object" && arguments[0]) {
                var g = arguments[0];
                for (var i in g) b.associate(i, g[i])
            } else if (arguments.length == 2) {
                var d = arguments[0],
                    h = arguments[1];
                if (typeof d !== "string") {
                    c(a);
                    return
                }
                if (typeof h !== "function") {
                    c(a);
                    return
                }
                var f = d.toUpperCase();
                b.m_mappings[f] && c("[DuplicatedName] Function=" + d);
                b.m_mappings[f] = h;
                for (var e = 0; e < b.m_onchangeHandlers.length; e++) b.m_onchangeHandlers[e]()
            } else c(a)
        };
        a.prototype.onchange = function (a) {
            a && this.m_onchangeHandlers.push(a)
        };
        Object.defineProperty(a.prototype, "mappings", {
            "get": function () {
                return this.m_mappings
            },
            enumerable: true,
            configurable: true
        });
        return a
    }();
    b.Association = a
})(OfficeExt || (OfficeExt = {}));
var CustomFunctionMappings = window.CustomFunctionMappings || {},
    CustomFunctions;
(function (a) {
    var b = "__delay__";

    function c() {
        CustomFunctionMappings[b] = true
    }
    a.delayInitialization = c;
    a._association = new OfficeExt.Association;

    function d() {
        a._association.associate.apply(a._association, arguments);
        delete CustomFunctionMappings[b]
    }
    a.associate = d
})(CustomFunctions || (CustomFunctions = {}));
(function (a) {
    var b;
    (function (a) {
        a._association = new OfficeExt.Association;

        function b() {
            a._association.associate.apply(a._association, arguments)
        }
        a.associate = b
    })(b = a.actions || (a.actions = {}))
})(Office || (Office = {}));
var g_isExpEnabled = g_isExpEnabled || false,
    g_isOfflineLibrary = g_isOfflineLibrary || false;
(function () {
    var a = OSF.ConstantNames || {};
    OSF.ConstantNames = {
        FileVersion: "16.0.14818.10000",
        OfficeJS: "office.js",
        OfficeDebugJS: "office.debug.js",
        DefaultLocale: "en-us",
        LocaleStringLoadingTimeout: 5e3,
        MicrosoftAjaxId: "MSAJAX",
        OfficeStringsId: "OFFICESTRINGS",
        OfficeJsId: "OFFICEJS",
        HostFileId: "HOST",
        O15MappingId: "O15Mapping",
        OfficeStringJS: "office_strings.js",
        O15InitHelper: "o15apptofilemappingtable.js",
        SupportedLocales: OSF.SupportedLocales,
        AssociatedLocales: OSF.AssociatedLocales,
        ExperimentScriptSuffix: "experiment"
    };
    for (var b in a) OSF.ConstantNames[b] = a[b]
})();
OSF.InitializationHelper = function (d, b, f, e, c) {
    var a = this;
    a._hostInfo = d;
    a._webAppState = b;
    a._context = f;
    a._settings = e;
    a._hostFacade = c
};
OSF.InitializationHelper.prototype.saveAndSetDialogInfo = function () {};
OSF.InitializationHelper.prototype.getAppContext = function () {};
OSF.InitializationHelper.prototype.setAgaveHostCommunication = function () {};
OSF.InitializationHelper.prototype.prepareRightBeforeWebExtensionInitialize = function () {};
OSF.InitializationHelper.prototype.loadAppSpecificScriptAndCreateOM = function () {};
OSF.InitializationHelper.prototype.prepareRightAfterWebExtensionInitialize = function () {};
OSF.HostInfoFlags = {
    SharedApp: 1,
    CustomFunction: 2,
    ProtectedDocDisable: 4,
    ExperimentJsEnabled: 8,
    PublicAddin: 16
};
OSF._OfficeAppFactory = function () {
    var m = "_host_Info",
        g = "function",
        a = "undefined",
        f = "",
        d = true,
        e = false,
        c = null,
        o = function (b, a) {
            if (a && b && !a[b]) a[b] = {}
        };
    o("Office", window);
    o("Microsoft", window);
    o("Office", Microsoft);
    o("WebExtension", Microsoft.Office);
    if (typeof window.Office === "object")
        for (var s in window.Office)
            if (window.Office.hasOwnProperty(s)) Microsoft.Office.WebExtension[s] = window.Office[s];
    window.Office = Microsoft.Office.WebExtension;
    var y = {
        0: "Unknown",
        1: "Hidden",
        2: "Taskpane",
        3: "Dialog"
    };
    Microsoft.Office.WebExtension.PlatformType = {
        PC: "PC",
        OfficeOnline: "OfficeOnline",
        Mac: "Mac",
        iOS: "iOS",
        Android: "Android",
        Universal: "Universal"
    };
    Microsoft.Office.WebExtension.HostType = {
        Word: "Word",
        Excel: "Excel",
        PowerPoint: "PowerPoint",
        Outlook: "Outlook",
        OneNote: "OneNote",
        Project: "Project",
        Access: "Access",
        Visio: "Visio"
    };
    var r = {},
        H = {},
        q = {},
        j = {
            id: c,
            webAppUrl: c,
            conversationID: c,
            clientEndPoint: c,
            wnd: window.parent,
            focused: e
        },
        b = {
            isO15: d,
            isRichClient: d,
            hostType: f,
            hostPlatform: f,
            hostSpecificFileVersion: f,
            hostLocale: f,
            osfControlAppCorrelationId: f,
            isDialog: e,
            disableLogging: e,
            flags: 0
        },
        l = d,
        i = {},
        w = c,
        v = e,
        n = [],
        u = e,
        k = {
            host: c,
            platform: c,
            addin: c
        },
        h = new ScriptLoading.LoadScriptHelper({
            OfficeJS: OSF.ConstantNames.OfficeJS,
            OfficeDebugJS: OSF.ConstantNames.OfficeDebugJS
        });
    window.performance && window.performance.now && h.logScriptLoading(OSF.ConstantNames.OfficeJsId, -1, window.performance.now());
    var C = window.location.hash,
        B = window.location.search,
        x = window.name,
        t = function (b) {
            var f = b.host,
                c = b.platform,
                e = b.addin;
            v = d;
            if (typeof OSFPerformance !== a) OSFPerformance.officeOnReady = OSFPerformance.now();
            k = {
                host: f,
                platform: c,
                addin: e
            };
            while (n.length > 0) n.shift()(k)
        };
    Microsoft.Office.WebExtension.FeatureGates = {};
    Microsoft.Office.WebExtension.sendTelemetryEvent = function (a) {
        OTel.OTelLogger.sendTelemetryEvent(a)
    };
    Microsoft.Office.WebExtension.telemetrySink = OTel.OTelLogger;
    Microsoft.Office.WebExtension.onReadyInternal = function (a) {
        if (v) {
            var e = k.host,
                c = k.platform,
                d = k.addin;
            if (a) {
                var b = a({
                    host: e,
                    platform: c,
                    addin: d
                });
                if (b && b.then && typeof b.then === g) return b.then(function () {
                    return Office.Promise.resolve({
                        host: e,
                        platform: c,
                        addin: d
                    })
                })
            }
            return Office.Promise.resolve({
                host: e,
                platform: c,
                addin: d
            })
        }
        if (a) return new Office.Promise(function (b) {
            n.push(function (d) {
                var c = a(d);
                if (c && c.then && typeof c.then === g) return c.then(function () {
                    return b(d)
                });
                b(d)
            })
        });
        return new Office.Promise(function (a) {
            n.push(a)
        })
    };
    Microsoft.Office.WebExtension.onReady = function (a) {
        u = d;
        return Microsoft.Office.WebExtension.onReadyInternal(a)
    };
    var p = function (g) {
            var c, d = window.location.search;
            if (d) {
                var b = d.split(g + "=");
                if (b.length > 1) {
                    var e = b[1],
                        f = new RegExp("[&#]", "g"),
                        a = e.split(f);
                    if (a.length > 0) c = a[0]
                }
            }
            return c
        },
        F = function (f, g) {
            var b = f.split("."),
                c = g.split("."),
                a;
            for (a in b)
                if (parseInt(b[a]) < parseInt(c[a])) return e;
                else if (parseInt(b[a]) > parseInt(c[a])) return d;
            return e
        },
        z = function () {
            try {
                var b = "15.30.1128.0",
                    a = window.external.GetContext().GetHostFullVersion()
            } catch (c) {
                return e
            }
            return !!F(b, a)
        },
        A = function () {
            l = d;
            try {
                if (b.disableLogging) {
                    l = e;
                    return
                }
                window.external = window.external || {};
                if (typeof window.external.GetLoggingAllowed === a) l = d;
                else l = window.external.GetLoggingAllowed()
            } catch (c) {}
        },
        E = function () {
            var i = "hostInfoValue",
                l = "isDialog",
                o = m,
                h = p(o);
            if (!h) try {
                var r = JSON.parse(x);
                h = r ? r["hostInfo"] : c
            } catch (s) {}
            if (!h) try {
                window.external = window.external || {};
                if (typeof agaveHost !== a && agaveHost.GetHostInfo) window.external.GetHostInfo = function () {
                    return agaveHost.GetHostInfo()
                };
                var k = window.external.GetHostInfo();
                if (k == l) {
                    b.isO15 = d;
                    b.isDialog = d
                } else if (k.toLowerCase().indexOf("mac") !== -1 && k.toLowerCase().indexOf("outlook") !== -1 && z()) b.isO15 = d;
                else {
                    var q = k.split(o + "=");
                    if (q.length > 1) h = q[1];
                    else h = k
                }
            } catch (s) {}
            var u = function () {
                    var a = c;
                    try {
                        if (window.sessionStorage) a = window.sessionStorage
                    } catch (b) {}
                    return a
                },
                j = u();
            if (!h && j && j.getItem(i)) h = j.getItem(i);
            if (h) {
                h = decodeURIComponent(h);
                b.isO15 = e;
                var g = h.split("$");
                if (typeof g[2] == a) g = h.split("|");
                b.hostType = typeof g[0] == a ? f : g[0].toLowerCase();
                b.hostPlatform = typeof g[1] == a ? f : g[1].toLowerCase();
                b.hostSpecificFileVersion = typeof g[2] == a ? f : g[2].toLowerCase();
                b.hostLocale = typeof g[3] == a ? f : g[3].toLowerCase();
                b.osfControlAppCorrelationId = typeof g[4] == a ? f : g[4];
                if (b.osfControlAppCorrelationId == "telemetry") b.osfControlAppCorrelationId = f;
                b.isDialog = typeof g[5] != a && g[5] == l ? d : e;
                b.disableLogging = typeof g[6] != a && g[6] == "disableLogging" ? d : e;
                b.flags = typeof g[7] === "string" && g[7].length > 0 ? parseInt(g[7]) : 0;
                if (g_isOfflineLibrary) g_isExpEnabled = e;
                else g_isExpEnabled = g_isExpEnabled || !!(b.flags & OSF.HostInfoFlags.ExperimentJsEnabled);
                var t = parseFloat(b.hostSpecificFileVersion),
                    n = OSF.HostSpecificFileVersionDefault;
                if (OSF.HostSpecificFileVersionMap[b.hostType] && OSF.HostSpecificFileVersionMap[b.hostType][b.hostPlatform]) n = OSF.HostSpecificFileVersionMap[b.hostType][b.hostPlatform];
                if (t > parseFloat(n)) b.hostSpecificFileVersion = n;
                if (j) try {
                    j.setItem(i, h)
                } catch (v) {}
            } else {
                b.isO15 = d;
                b.hostLocale = p("locale")
            }
        },
        D = function (b, a) {
            OSF.AppTelemetry && OSF.AppTelemetry.logAppCommonMessage && OSF.AppTelemetry.logAppCommonMessage("getAppContextAsync starts");
            i.getAppContext(b, a)
        },
        G = function () {
            E();
            A();
            if (b.hostPlatform == "web" && b.isDialog && window == window.top && window.opener == c) {
                window.open(f, "_self", f);
                window.close()
            }
            if ((b.flags & (OSF.HostInfoFlags.SharedApp | OSF.HostInfoFlags.CustomFunction)) !== 0)
                if (typeof window.Promise === a) window.Promise = window.Office.Promise;
            h.setAppCorrelationId(b.osfControlAppCorrelationId);
            var k = h.getOfficeJsBasePath(),
                B = e;
            if (!k) throw "Office Web Extension script library file name should be " + OSF.ConstantNames.OfficeJS + " or " + OSF.ConstantNames.OfficeDebugJS + ".";
            var n = function () {
                    if (typeof Sys !== a && typeof Type !== a && Sys.StringBuilder && typeof Sys.StringBuilder === g && Type.registerNamespace && typeof Type.registerNamespace === g && Type.registerClass && typeof Type.registerClass === g || typeof OfficeExt !== a && OfficeExt.MsAjaxError) return d;
                    else return e
                },
                o = c,
                v = function (f) {
                    var b = e,
                        c = function () {
                            if (typeof Strings == a || typeof Strings.OfficeOM == a)
                                if (!b) {
                                    b = d;
                                    var g = k + OSF.ConstantNames.DefaultLocale + "/" + OSF.ConstantNames.OfficeStringJS;
                                    h.loadScript(g, OSF.ConstantNames.OfficeStringsId, c, d, OSF.ConstantNames.LocaleStringLoadingTimeout);
                                    return e
                                } else throw "Neither the locale, " + f.toLowerCase() + ", provided by the host app nor the fallback locale " + OSF.ConstantNames.DefaultLocale + " are supported.";
                            else {
                                b = e;
                                o = Strings.OfficeOM
                            }
                        };
                    if (!n()) {
                        window.Type = Function;
                        Type.registerNamespace = function (a) {
                            window[a] = window[a] || {}
                        };
                        Type.prototype.registerClass = function (a) {
                            a = {}
                        }
                    }
                    var g = k + OSF.getSupportedLocale(f, OSF.ConstantNames.DefaultLocale) + "/" + OSF.ConstantNames.OfficeStringJS;
                    h.loadScript(g, OSF.ConstantNames.OfficeStringsId, c, d, OSF.ConstantNames.LocaleStringLoadingTimeout)
                },
                s = function (s) {
                    if (s) {
                        i = new OSF.InitializationHelper(b, j, r, H, q);
                        b.hostPlatform == "web" && i.saveAndSetDialogInfo && i.saveAndSetDialogInfo(p(m));
                        i.setAgaveHostCommunication();
                        if (typeof OSFPerformance !== a) OSFPerformance.getAppContextStart = OSFPerformance.now();
                        D(j.wnd, function (d) {
                            if (typeof OSFPerformance !== a) OSFPerformance.getAppContextEnd = OSFPerformance.now();
                            OSF.AppTelemetry && OSF.AppTelemetry.logAppCommonMessage && OSF.AppTelemetry.logAppCommonMessage("getAppContextAsync callback start");
                            w = d._appInstanceId;
                            if (d.get_featureGates) {
                                var e = d.get_featureGates();
                                if (e) Microsoft.Office.WebExtension.FeatureGates = e
                            }
                            var f = function () {
                                var a = b.hostSpecificFileVersion.split(".");
                                if (d.get_appMinorVersion) {
                                    var c = b.hostPlatform == "ios";
                                    if (!c)
                                        if (isNaN(d.get_appMinorVersion())) d._appMinorVersion = parseInt(a[1]);
                                        else if (a.length > 1 && !isNaN(Number(a[1]))) d._appMinorVersion = parseInt(a[1])
                                }
                                if (b.isDialog) d._isDialog = b.isDialog
                            };
                            f();
                            var j = function () {
                                i.prepareApiSurface && i.prepareApiSurface(d);
                                h.waitForFunction(function () {
                                    return Microsoft.Office.WebExtension.initialize != undefined || u
                                }, function (f) {
                                    if (f) {
                                        if (i.prepareApiSurface) Microsoft.Office.WebExtension.initialize && Microsoft.Office.WebExtension.initialize(i.getInitializationReason(d));
                                        else {
                                            if (!Microsoft.Office.WebExtension.initialize) Microsoft.Office.WebExtension.initialize = function () {};
                                            i.prepareRightBeforeWebExtensionInitialize(d)
                                        }
                                        i.prepareRightAfterWebExtensionInitialize && i.prepareRightAfterWebExtensionInitialize(d);
                                        var e = d.get_appName(),
                                            a = c;
                                        if ((b.flags & OSF.HostInfoFlags.SharedApp) !== 0) a = {
                                            visibilityMode: y[d.get_initialDisplayMode && typeof d.get_initialDisplayMode === g ? d.get_initialDisplayMode() : 0]
                                        };
                                        t({
                                            host: OfficeExt.HostName.Host.getInstance().getHost(e),
                                            platform: OfficeExt.HostName.Host.getInstance().getPlatform(e),
                                            addin: a
                                        })
                                    } else throw new Error('Office.js has not fully loaded. Your app must call "Office.onReady()" as part of it\'s loading sequence (or set the "Office.initialize" function). If your app has this functionality, try reloading this page.')
                                }, 400, 50)
                            };
                            !h.isScriptLoading(OSF.ConstantNames.OfficeStringsId) && v(d.get_appUILocale());
                            h.waitForScripts([OSF.ConstantNames.OfficeStringsId], function () {
                                if (o && !Strings.OfficeOM) Strings.OfficeOM = o;
                                i.loadAppSpecificScriptAndCreateOM(d, j, k);
                                if (typeof OSFPerformance !== a) OSFPerformance.createOMEnd = OSFPerformance.now()
                            })
                        });
                        if (b.isO15) {
                            var n = OSF.OUtil.parseXdmInfo() == c;
                            if (n) {
                                var f = d;
                                if (window.external && typeof window.external.GetContext !== a) try {
                                    window.external.GetContext();
                                    f = e
                                } catch (x) {}
                                if (typeof OsfOptOut === a && f && window.top !== window.self) {
                                    window.console && window.console.log && window.console.log("The add-in is not hosted in plain browser top window.");
                                    window.location.href = "about:blank"
                                }
                                f && t({
                                    host: c,
                                    platform: c,
                                    addin: c
                                })
                            }
                        }
                    } else {
                        var l = "MicrosoftAjax.js is not loaded successfully.";
                        OSF.AppTelemetry && OSF.AppTelemetry.logAppException && OSF.AppTelemetry.logAppException(l);
                        throw l
                    }
                },
                x = function () {
                    OSF.AppTelemetry && OSF.AppTelemetry.setOsfControlAppCorrelationId && OSF.AppTelemetry.setOsfControlAppCorrelationId(b.osfControlAppCorrelationId);
                    if (h.isScriptLoading(OSF.ConstantNames.MicrosoftAjaxId)) h.waitForScripts([OSF.ConstantNames.MicrosoftAjaxId], s);
                    else h.waitForFunction(n, s, 500, 100)
                };
            if (b.isO15) h.loadScript(k + OSF.ConstantNames.O15InitHelper, OSF.ConstantNames.O15MappingId, x);
            else {
                var l;
                l = [b.hostType, b.hostPlatform, b.hostSpecificFileVersion, OSF.ConstantNames.HostFileScriptSuffix || c].filter(function (a) {
                    return a != c
                }).join("-") + ".js";
                h.loadScript(k + l.toLowerCase(), OSF.ConstantNames.HostFileId, x);
                if (typeof OSFPerformance !== a) OSFPerformance.hostSpecificFileName = l.toLowerCase()
            }
            b.hostLocale && v(b.hostLocale);
            if (B && !n()) {
                var C = (window.location.protocol.toLowerCase() === "https:" ? "https:" : "http:") + "//ajax.aspnetcdn.com/ajax/3.5/MicrosoftAjax.js";
                h.loadScriptParallel(C, OSF.ConstantNames.MicrosoftAjaxId)
            }
            window.confirm = function () {
                throw new Error("Function window.confirm is not supported.")
            };
            window.alert = function () {
                throw new Error("Function window.alert is not supported.")
            };
            window.prompt = function () {
                throw new Error("Function window.prompt is not supported.")
            };
            var z = b.hostType == "outlook" && b.hostPlatform == "android";
            if (!z) {
                window.history.replaceState = c;
                window.history.pushState = c
            }
        };
    G();
    window.addEventListener && window.addEventListener("DOMContentLoaded", function () {
        Microsoft.Office.WebExtension.onReadyInternal(function () {
            typeof OSFPerfUtil !== a && OSFPerfUtil.sendPerformanceTelemetry()
        })
    });
    return {
        getId: function () {
            return j.id
        },
        getClientEndPoint: function () {
            return j.clientEndPoint
        },
        getContext: function () {
            return r
        },
        setContext: function (a) {
            r = a
        },
        getHostInfo: function () {
            return b
        },
        getLoggingAllowed: function () {
            return l
        },
        getHostFacade: function () {
            return q
        },
        setHostFacade: function (a) {
            q = a
        },
        getInitializationHelper: function () {
            return i
        },
        getCachedSessionSettingsKey: function () {
            return (j.conversationID != c ? j.conversationID : w) + "CachedSessionSettings"
        },
        getWebAppState: function () {
            return j
        },
        getWindowLocationHash: function () {
            return C
        },
        getWindowLocationSearch: function () {
            return B
        },
        getLoadScriptHelper: function () {
            return h
        },
        getWindowName: function () {
            return x
        }
    }
}()



var oteljs = function (t) {
    var e = {};

    function n(r) {
        if (e[r]) return e[r].exports;
        var i = e[r] = {
            i: r,
            l: !1,
            exports: {}
        };
        return t[r].call(i.exports, i, i.exports, n), i.l = !0, i.exports
    }
    return n.m = t, n.c = e, n.d = function (t, e, r) {
        n.o(t, e) || Object.defineProperty(t, e, {
            enumerable: !0,
            get: r
        })
    }, n.r = function (t) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(t, "__esModule", {
            value: !0
        })
    }, n.t = function (t, e) {
        if (1 & e && (t = n(t)), 8 & e) return t;
        if (4 & e && "object" == typeof t && t && t.__esModule) return t;
        var r = Object.create(null);
        if (n.r(r), Object.defineProperty(r, "default", {
                enumerable: !0,
                value: t
            }), 2 & e && "string" != typeof t)
            for (var i in t) n.d(r, i, function (e) {
                return t[e]
            }.bind(null, i));
        return r
    }, n.n = function (t) {
        var e = t && t.__esModule ? function () {
            return t.default
        } : function () {
            return t
        };
        return n.d(e, "a", e), e
    }, n.o = function (t, e) {
        return Object.prototype.hasOwnProperty.call(t, e)
    }, n.p = "", n(n.s = 19)
}([function (t, e, n) {
    "use strict";
    n.d(e, "a", (function () {
        return o
    })), n.d(e, "d", (function () {
        return a
    })), n.d(e, "b", (function () {
        return c
    })), n.d(e, "e", (function () {
        return s
    })), n.d(e, "c", (function () {
        return u
    }));
    var r = n(3),
        i = n(4);

    function o(t, e) {
        return {
            name: t,
            dataType: r.a.Boolean,
            value: e,
            classification: i.a.SystemMetadata
        }
    }

    function a(t, e) {
        return {
            name: t,
            dataType: r.a.Int64,
            value: e,
            classification: i.a.SystemMetadata
        }
    }

    function c(t, e) {
        return {
            name: t,
            dataType: r.a.Double,
            value: e,
            classification: i.a.SystemMetadata
        }
    }

    function s(t, e) {
        return {
            name: t,
            dataType: r.a.String,
            value: e,
            classification: i.a.SystemMetadata
        }
    }

    function u(t, e) {
        return {
            name: t,
            dataType: r.a.Guid,
            value: e,
            classification: i.a.SystemMetadata
        }
    }
}, function (t, e, n) {
    "use strict";
    n.d(e, "b", (function () {
        return r
    })), n.d(e, "a", (function () {
        return i
    })), n.d(e, "e", (function () {
        return a
    })), n.d(e, "d", (function () {
        return c
    })), n.d(e, "c", (function () {
        return s
    }));
    var r, i, o = new(n(10).a);

    function a() {
        return o
    }

    function c(t, e, n) {
        o.fireEvent({
            level: t,
            category: e,
            message: n
        })
    }

    function s(t, e, n) {
        c(r.Error, t, (function () {
            var t = n instanceof Error ? n.message : "";
            return e + ": " + t
        }))
    }! function (t) {
        t[t.Error = 0] = "Error", t[t.Warning = 1] = "Warning", t[t.Info = 2] = "Info", t[t.Verbose = 3] = "Verbose"
    }(r || (r = {})),
    function (t) {
        t[t.Core = 0] = "Core", t[t.Sink = 1] = "Sink", t[t.Transport = 2] = "Transport"
    }(i || (i = {}))
}, function (t, e, n) {
    "use strict";
    n.d(e, "a", (function () {
        return i
    }));
    var r = n(0);

    function i(t, e, n) {
        t.push(Object(r.e)("zC." + e, n))
    }
}, function (t, e, n) {
    "use strict";
    var r;
    n.d(e, "a", (function () {
            return r
        })),
        function (t) {
            t[t.String = 0] = "String", t[t.Boolean = 1] = "Boolean", t[t.Int64 = 2] = "Int64", t[t.Double = 3] = "Double", t[t.Guid = 4] = "Guid"
        }(r || (r = {}))
}, function (t, e, n) {
    "use strict";
    var r;
    n.d(e, "a", (function () {
            return r
        })),
        function (t) {
            t[t.EssentialServiceMetadata = 1] = "EssentialServiceMetadata", t[t.AccountData = 2] = "AccountData", t[t.SystemMetadata = 4] = "SystemMetadata", t[t.OrganizationIdentifiableInformation = 8] = "OrganizationIdentifiableInformation", t[t.EndUserIdentifiableInformation = 16] = "EndUserIdentifiableInformation", t[t.CustomerContent = 32] = "CustomerContent", t[t.AccessControl = 64] = "AccessControl"
        }(r || (r = {}))
}, function (t, e, n) {
    "use strict";
    var r, i, o, a, c;
    n.d(e, "e", (function () {
            return r
        })), n.d(e, "d", (function () {
            return i
        })), n.d(e, "a", (function () {
            return o
        })), n.d(e, "b", (function () {
            return a
        })), n.d(e, "c", (function () {
            return c
        })),
        function (t) {
            t[t.NotSet = 0] = "NotSet", t[t.Measure = 1] = "Measure", t[t.Diagnostics = 2] = "Diagnostics", t[t.CriticalBusinessImpact = 191] = "CriticalBusinessImpact", t[t.CriticalCensus = 192] = "CriticalCensus", t[t.CriticalExperimentation = 193] = "CriticalExperimentation", t[t.CriticalUsage = 194] = "CriticalUsage"
        }(r || (r = {})),
        function (t) {
            t[t.NotSet = 0] = "NotSet", t[t.Normal = 1] = "Normal", t[t.High = 2] = "High"
        }(i || (i = {})),
        function (t) {
            t[t.NotSet = 0] = "NotSet", t[t.Normal = 1] = "Normal", t[t.High = 2] = "High"
        }(o || (o = {})),
        function (t) {
            t[t.NotSet = 0] = "NotSet", t[t.SoftwareSetup = 1] = "SoftwareSetup", t[t.ProductServiceUsage = 2] = "ProductServiceUsage", t[t.ProductServicePerformance = 4] = "ProductServicePerformance", t[t.DeviceConfiguration = 8] = "DeviceConfiguration", t[t.InkingTypingSpeech = 16] = "InkingTypingSpeech"
        }(a || (a = {})),
        function (t) {
            t[t.ReservedDoNotUse = 0] = "ReservedDoNotUse", t[t.BasicEvent = 10] = "BasicEvent", t[t.FullEvent = 100] = "FullEvent", t[t.NecessaryServiceDataEvent = 110] = "NecessaryServiceDataEvent", t[t.AlwaysOnNecessaryServiceDataEvent = 120] = "AlwaysOnNecessaryServiceDataEvent"
        }(c || (c = {}))
}, function (t, e, n) {
    "use strict";
    n.d(e, "a", (function () {
        return p
    }));
    var r, i, o, a, c, s, u, d, f, l = n(0),
        v = n(2);
    (r || (r = {})).getFields = function (t, e) {
            var n = [];
            return n.push(Object(l.d)(t + ".Code", e.code)), void 0 !== e.type && n.push(Object(l.e)(t + ".Type", e.type)), void 0 !== e.tag && n.push(Object(l.d)(t + ".Tag", e.tag)), void 0 !== e.isExpected && n.push(Object(l.a)(t + ".IsExpected", e.isExpected)), Object(v.a)(n, t, "Office.System.Result"), n
        }, (o = i || (i = {})).contractName = "Office.System.Activity", o.getFields = function (t) {
            var e = [];
            return void 0 !== t.cV && e.push(Object(l.e)("Activity.CV", t.cV)), e.push(Object(l.d)("Activity.Duration", t.duration)), e.push(Object(l.d)("Activity.Count", t.count)), e.push(Object(l.d)("Activity.AggMode", t.aggMode)), void 0 !== t.success && e.push(Object(l.a)("Activity.Success", t.success)), void 0 !== t.result && e.push.apply(e, r.getFields("Activity.Result", t.result)), Object(v.a)(e, "Activity", o.contractName), e
        }, (a || (a = {})).getFields = function (t, e) {
            var n = [];
            return void 0 !== e.id && n.push(Object(l.e)(t + ".Id", e.id)), void 0 !== e.version && n.push(Object(l.e)(t + ".Version", e.version)), void 0 !== e.sessionId && n.push(Object(l.e)(t + ".SessionId", e.sessionId)), Object(v.a)(n, t, "Office.System.Host"), n
        }, (c || (c = {})).getFields = function (t, e) {
            var n = [];
            return void 0 !== e.alias && n.push(Object(l.e)(t + ".Alias", e.alias)), void 0 !== e.primaryIdentityHash && n.push(Object(l.e)(t + ".PrimaryIdentityHash", e.primaryIdentityHash)), void 0 !== e.primaryIdentitySpace && n.push(Object(l.e)(t + ".PrimaryIdentitySpace", e.primaryIdentitySpace)), void 0 !== e.tenantId && n.push(Object(l.e)(t + ".TenantId", e.tenantId)), void 0 !== e.tenantGroup && n.push(Object(l.e)(t + ".TenantGroup", e.tenantGroup)), void 0 !== e.isAnonymous && n.push(Object(l.a)(t + ".IsAnonymous", e.isAnonymous)), Object(v.a)(n, t, "Office.System.User"), n
        }, (s || (s = {})).getFields = function (t, e) {
            var n = [];
            return void 0 !== e.id && n.push(Object(l.e)(t + ".Id", e.id)), void 0 !== e.version && n.push(Object(l.e)(t + ".Version", e.version)), void 0 !== e.instanceId && n.push(Object(l.e)(t + ".InstanceId", e.instanceId)), void 0 !== e.name && n.push(Object(l.e)(t + ".Name", e.name)), void 0 !== e.marketplaceType && n.push(Object(l.e)(t + ".MarketplaceType", e.marketplaceType)), void 0 !== e.sessionId && n.push(Object(l.e)(t + ".SessionId", e.sessionId)), void 0 !== e.browserToken && n.push(Object(l.e)(t + ".BrowserToken", e.browserToken)), void 0 !== e.osfRuntimeVersion && n.push(Object(l.e)(t + ".OsfRuntimeVersion", e.osfRuntimeVersion)), void 0 !== e.officeJsVersion && n.push(Object(l.e)(t + ".OfficeJsVersion", e.officeJsVersion)), void 0 !== e.hostJsVersion && n.push(Object(l.e)(t + ".HostJsVersion", e.hostJsVersion)), void 0 !== e.assetId && n.push(Object(l.e)(t + ".AssetId", e.assetId)), void 0 !== e.providerName && n.push(Object(l.e)(t + ".ProviderName", e.providerName)), void 0 !== e.type && n.push(Object(l.e)(t + ".Type", e.type)), Object(v.a)(n, t, "Office.System.SDX"), n
        }, (u || (u = {})).getFields = function (t, e) {
            var n = [];
            return void 0 !== e.name && n.push(Object(l.e)(t + ".Name", e.name)), void 0 !== e.state && n.push(Object(l.e)(t + ".State", e.state)), Object(v.a)(n, t, "Office.System.Funnel"), n
        }, (d || (d = {})).getFields = function (t, e) {
            var n = [];
            return void 0 !== e.id && n.push(Object(l.d)(t + ".Id", e.id)), void 0 !== e.name && n.push(Object(l.e)(t + ".Name", e.name)), void 0 !== e.commandSurface && n.push(Object(l.e)(t + ".CommandSurface", e.commandSurface)), void 0 !== e.parentName && n.push(Object(l.e)(t + ".ParentName", e.parentName)), void 0 !== e.triggerMethod && n.push(Object(l.e)(t + ".TriggerMethod", e.triggerMethod)), void 0 !== e.timeOffsetMs && n.push(Object(l.d)(t + ".TimeOffsetMs", e.timeOffsetMs)), Object(v.a)(n, t, "Office.System.UserAction"), n
        },
        function (t) {
            t.getFields = function (t, e) {
                var n = [];
                return n.push(Object(l.e)(t + ".ErrorGroup", e.errorGroup)), n.push(Object(l.d)(t + ".Tag", e.tag)), void 0 !== e.code && n.push(Object(l.d)(t + ".Code", e.code)), void 0 !== e.id && n.push(Object(l.d)(t + ".Id", e.id)), void 0 !== e.count && n.push(Object(l.d)(t + ".Count", e.count)), Object(v.a)(n, t, "Office.System.Error"), n
            }
        }(f || (f = {}));
    var p, y = i,
        h = r,
        g = f,
        m = u,
        b = a,
        F = s,
        O = d,
        S = c;
    ! function (t) {
        ! function (t) {
            ! function (t) {
                t.Activity = y, t.Result = h, t.Error = g, t.Funnel = m, t.Host = b, t.SDX = F, t.User = S, t.UserAction = O
            }(t.System || (t.System = {}))
        }(t.Office || (t.Office = {}))
    }(p || (p = {}))
}, function (t, e, n) {
    "use strict";

    function r(t) {
        var e = {
            eventName: t.eventName,
            eventFlags: t.eventFlags
        };
        return t.telemetryProperties && (e.telemetryProperties = {
            ariaTenantToken: t.telemetryProperties.ariaTenantToken,
            nexusTenantToken: t.telemetryProperties.nexusTenantToken
        }), t.eventContract && (e.eventContract = {
            name: t.eventContract.name,
            dataFields: t.eventContract.dataFields.slice()
        }), e.dataFields = t.dataFields ? t.dataFields.slice() : [], e
    }
    n.d(e, "a", (function () {
        return r
    }))
}, function (t, e, n) {
    "use strict";
    n.d(e, "b", (function () {
        return l
    })), n.d(e, "a", (function () {
        return v
    }));
    var r, i, o = n(7),
        a = n(1);
    ! function (t) {
        t[t.Aria = 0] = "Aria", t[t.Nexus = 1] = "Nexus"
    }(r || (r = {})),
    function (t) {
        var e = {},
            n = {},
            i = {};

        function o(t) {
            if ("object" != typeof t) throw new Error("tokenTree must be an object");
            i = function t(e, n) {
                if ("object" != typeof n) return n;
                for (var r = 0, i = Object.keys(n); r < i.length; r++) {
                    var o = i[r];
                    o in e && (e[o], 1) ? e[o] = t(e[o], n[o]) : e[o] = n[o]
                }
                return e
            }(i, t)
        }

        function c(t) {
            if (e[t]) return e[t];
            var n = u(t, r.Aria);
            return "string" == typeof n ? (e[t] = n, n) : void 0
        }

        function s(t) {
            if (n[t]) return n[t];
            var e = u(t, r.Nexus);
            return "number" == typeof e ? (n[t] = e, e) : void 0
        }

        function u(t, e) {
            var n = t.split("."),
                o = i,
                a = void 0;
            if (o) {
                for (var c = 0; c < n.length - 1; c++) o[n[c]] && (o = o[n[c]], e === r.Aria && "string" == typeof o.ariaTenantToken ? a = o.ariaTenantToken : e === r.Nexus && "number" == typeof o.nexusTenantToken && (a = o.nexusTenantToken));
                return a
            }
        }
        t.setTenantToken = function (t, e, n) {
            var r = t.split(".");
            if (r.length < 2 || "Office" !== r[0]) Object(a.d)(a.b.Error, a.a.Core, (function () {
                return "Invalid namespace: " + t
            }));
            else {
                var i = Object.create(Object.prototype);
                e && (i.ariaTenantToken = e), n && (i.nexusTenantToken = n);
                var c, s = i;
                for (c = r.length - 1; c >= 0; --c) {
                    var u = Object.create(Object.prototype);
                    u[r[c]] = s, s = u
                }
                o(s)
            }
        }, t.setTenantTokens = o, t.getTenantTokens = function (t) {
            var e = c(t),
                n = s(t);
            if (!n || !e) throw new Error("Could not find tenant token for " + t);
            return {
                ariaTenantToken: e,
                nexusTenantToken: n
            }
        }, t.getAriaTenantToken = c, t.getNexusTenantToken = s, t.clear = function () {
            e = {}, n = {}, i = {}
        }
    }(i || (i = {}));
    var c, s = n(3);
    ! function (t) {
        var e = /^[A-Z][a-zA-Z0-9]*$/,
            n = /^[a-zA-Z0-9_\.]*$/;

        function r(t) {
            return void 0 !== t && n.test(t)
        }

        function i(t) {
            if (!((e = t.name) && r(e) && e.length + 5 < 100)) throw new Error("Invalid dataField name");
            var e;
            t.dataType === s.a.Int64 && o(t.value)
        }

        function o(t) {
            if ("number" != typeof t || !isFinite(t) || Math.floor(t) !== t || t < -9007199254740991 || t > 9007199254740991) throw new Error("Invalid integer " + JSON.stringify(t))
        }
        t.validateTelemetryEvent = function (t) {
            if (! function (t) {
                    if (!t || t.length > 98) return !1;
                    var n = t.split("."),
                        r = n[n.length - 1];
                    return function (t) {
                        return !!t && t.length >= 3 && "Office" === t[0]
                    }(n) && (i = r, void 0 !== i && e.test(i));
                    var i
                }(t.eventName)) throw new Error("Invalid eventName");
            if (t.eventContract && !r(t.eventContract.name)) throw new Error("Invalid eventContract");
            if (null != t.dataFields)
                for (var n = 0; n < t.dataFields.length; n++) i(t.dataFields[n])
        }, t.validateInt = o
    }(c || (c = {}));
    var u = n(10),
        d = n(0),
        f = function () {
            return (f = Object.assign || function (t) {
                for (var e, n = 1, r = arguments.length; n < r; n++)
                    for (var i in e = arguments[n]) Object.prototype.hasOwnProperty.call(e, i) && (t[i] = e[i]);
                return t
            }).apply(this, arguments)
        },
        l = -1,
        v = function () {
            function t(t, e, n) {
                var r, i;
                this.onSendEvent = new u.a, this.persistentDataFields = [], this.config = n || {}, t && (this.onSendEvent = t.onSendEvent, (r = this.persistentDataFields).push.apply(r, t.persistentDataFields), this.config = f(f({}, t.getConfig()), this.config)), e && (i = this.persistentDataFields).push.apply(i, e)
            }
            return t.prototype.sendTelemetryEvent = function (t) {
                var e;
                try {
                    if (0 === this.onSendEvent.getListenerCount()) return void Object(a.d)(a.b.Warning, a.a.Core, (function () {
                        return "No telemetry sinks are attached."
                    }));
                    e = this.cloneEvent(t), this.processTelemetryEvent(e)
                } catch (t) {
                    return void Object(a.c)(a.a.Core, "SendTelemetryEvent", t)
                }
                try {
                    this.onSendEvent.fireEvent(e)
                } catch (t) {}
            }, t.prototype.processTelemetryEvent = function (t) {
                var e;
                t.telemetryProperties || (t.telemetryProperties = i.getTenantTokens(t.eventName)), t.dataFields && (t.dataFields.unshift(Object(d.e)("OTelJS.Version", "3.1.74")), this.persistentDataFields && (e = t.dataFields).unshift.apply(e, this.persistentDataFields)), this.config.disableValidation || c.validateTelemetryEvent(t)
            }, t.prototype.addSink = function (t) {
                this.onSendEvent.addListener((function (e) {
                    return t.sendTelemetryEvent(e)
                }))
            }, t.prototype.setTenantToken = function (t, e, n) {
                i.setTenantToken(t, e, n)
            }, t.prototype.setTenantTokens = function (t) {
                i.setTenantTokens(t)
            }, t.prototype.cloneEvent = function (t) {
                return Object(o.a)(t)
            }, t.prototype.getConfig = function () {
                return this.config
            }, t
        }()
}, function (t, e, n) {
    "use strict";
    var r;
    n.d(e, "a", (function () {
            return s
        })),
        function (t) {
            var e, n = 0;
            t.getNext = function () {
                return void 0 === e && (e = function () {
                    for (var t = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/", e = [], n = 0; n < 22; n++) e.push(t.charAt(Math.floor(Math.random() * t.length)));
                    return e.join("")
                }()), new r(e, ++n)
            }, t.getNextChild = function (t) {
                return new r(t.getString(), ++t.nextChild)
            };
            var r = function () {
                function t(t, e) {
                    this.base = t, this.id = e, this.nextChild = 0
                }
                return t.prototype.getString = function () {
                    return this.base + "." + this.id
                }, t
            }();
            t.CV = r
        }(r || (r = {}));
    var i = n(1),
        o = function (t, e, n, r) {
            return new(n || (n = Promise))((function (i, o) {
                function a(t) {
                    try {
                        s(r.next(t))
                    } catch (t) {
                        o(t)
                    }
                }

                function c(t) {
                    try {
                        s(r.throw(t))
                    } catch (t) {
                        o(t)
                    }
                }

                function s(t) {
                    var e;
                    t.done ? i(t.value) : (e = t.value, e instanceof n ? e : new n((function (t) {
                        t(e)
                    }))).then(a, c)
                }
                s((r = r.apply(t, e || [])).next())
            }))
        },
        a = function (t, e) {
            var n, r, i, o, a = {
                label: 0,
                sent: function () {
                    if (1 & i[0]) throw i[1];
                    return i[1]
                },
                trys: [],
                ops: []
            };
            return o = {
                next: c(0),
                throw: c(1),
                return: c(2)
            }, "function" == typeof Symbol && (o[Symbol.iterator] = function () {
                return this
            }), o;

            function c(o) {
                return function (c) {
                    return function (o) {
                        if (n) throw new TypeError("Generator is already executing.");
                        for (; a;) try {
                            if (n = 1, r && (i = 2 & o[0] ? r.return : o[0] ? r.throw || ((i = r.return) && i.call(r), 0) : r.next) && !(i = i.call(r, o[1])).done) return i;
                            switch (r = 0, i && (o = [2 & o[0], i.value]), o[0]) {
                                case 0:
                                case 1:
                                    i = o;
                                    break;
                                case 4:
                                    return a.label++, {
                                        value: o[1],
                                        done: !1
                                    };
                                case 5:
                                    a.label++, r = o[1], o = [0];
                                    continue;
                                case 7:
                                    o = a.ops.pop(), a.trys.pop();
                                    continue;
                                default:
                                    if (!(i = a.trys, (i = i.length > 0 && i[i.length - 1]) || 6 !== o[0] && 2 !== o[0])) {
                                        a = 0;
                                        continue
                                    }
                                    if (3 === o[0] && (!i || o[1] > i[0] && o[1] < i[3])) {
                                        a.label = o[1];
                                        break
                                    }
                                    if (6 === o[0] && a.label < i[1]) {
                                        a.label = i[1], i = o;
                                        break
                                    }
                                    if (i && a.label < i[2]) {
                                        a.label = i[2], a.ops.push(o);
                                        break
                                    }
                                    i[2] && a.ops.pop(), a.trys.pop();
                                    continue
                            }
                            o = e.call(t, a)
                        } catch (t) {
                            o = [6, t], r = 0
                        } finally {
                            n = i = 0
                        }
                        if (5 & o[0]) throw o[1];
                        return {
                            value: o[0] ? o[1] : void 0,
                            done: !0
                        }
                    }([o, c])
                }
            }
        },
        c = function () {
            return 1e3 * Date.now()
        };
    "object" == typeof window && "object" == typeof window.performance && "now" in window.performance && (c = function () {
        return 1e3 * Math.floor(window.performance.now())
    });
    var s = function () {
        function t(t, e, n) {
            this._optionalEventFlags = {}, this._ended = !1, this._telemetryLogger = t, this._activityName = e, this._cv = n ? r.getNextChild(n._cv) : r.getNext(), this._dataFields = [], this._success = void 0, this._startTime = c()
        }
        return t.createNew = function (e, n) {
            return new t(e, n)
        }, t.prototype.createChildActivity = function (e) {
            return new t(this._telemetryLogger, e, this)
        }, t.prototype.setEventFlags = function (t) {
            this._optionalEventFlags = t
        }, t.prototype.addDataField = function (t) {
            this._dataFields.push(t)
        }, t.prototype.addDataFields = function (t) {
            var e;
            (e = this._dataFields).push.apply(e, t)
        }, t.prototype.setSuccess = function (t) {
            this._success = t
        }, t.prototype.setResult = function (t, e, n) {
            this._result = {
                code: t,
                type: e,
                tag: n
            }
        }, t.prototype.endNow = function () {
            if (!this._ended) {
                void 0 === this._success && void 0 === this._result && Object(i.d)(i.b.Warning, i.a.Core, (function () {
                    return "Activity does not have success or result set"
                }));
                var t = c() - this._startTime;
                this._ended = !0;
                var e = {
                    duration: t,
                    count: 1,
                    aggMode: 0,
                    cV: this._cv.getString(),
                    success: this._success,
                    result: this._result
                };
                return this._telemetryLogger.sendActivity(this._activityName, e, this._dataFields, this._optionalEventFlags)
            }
            Object(i.d)(i.b.Error, i.a.Core, (function () {
                return "Activity has already ended"
            }))
        }, t.prototype.executeAsync = function (t) {
            return o(this, void 0, void 0, (function () {
                var e = this;
                return a(this, (function (n) {
                    return [2, t(this).then((function (t) {
                        return e.endNow(), t
                    })).catch((function (t) {
                        throw e.endNow(), t
                    }))]
                }))
            }))
        }, t.prototype.executeSync = function (t) {
            try {
                var e = t(this);
                return this.endNow(), e
            } catch (t) {
                throw this.endNow(), t
            }
        }, t.prototype.executeChildActivityAsync = function (t, e) {
            return o(this, void 0, void 0, (function () {
                return a(this, (function (n) {
                    return [2, this.createChildActivity(t).executeAsync(e)]
                }))
            }))
        }, t.prototype.executeChildActivitySync = function (t, e) {
            return this.createChildActivity(t).executeSync(e)
        }, t
    }()
}, function (t, e, n) {
    "use strict";
    n.d(e, "a", (function () {
        return r
    }));
    var r = function () {
        function t() {
            this._listeners = []
        }
        return t.prototype.fireEvent = function (t) {
            this._listeners.forEach((function (e) {
                return e(t)
            }))
        }, t.prototype.addListener = function (t) {
            t && this._listeners.push(t)
        }, t.prototype.removeListener = function (t) {
            this._listeners = this._listeners.filter((function (e) {
                return e !== t
            }))
        }, t.prototype.getListenerCount = function () {
            return this._listeners.length
        }, t
    }()
}, function (t, e, n) {
    "use strict";
    n.r(e);
    var r = n(6);
    n.d(e, "Contracts", (function () {
        return r.a
    }));
    var i = n(9);
    n.d(e, "ActivityScope", (function () {
        return i.a
    }));
    var o = n(2);
    n.d(e, "addContractField", (function () {
        return o.a
    }));
    var a = n(12);
    n.d(e, "getFieldsForContract", (function () {
        return a.a
    }));
    var c = n(4);
    n.d(e, "DataClassification", (function () {
        return c.a
    }));
    var s = n(13);
    for (var u in s)["default", "Contracts", "ActivityScope", "addContractField", "getFieldsForContract", "DataClassification"].indexOf(u) < 0 && function (t) {
        n.d(e, t, (function () {
            return s[t]
        }))
    }(u);
    var d = n(0);
    n.d(e, "makeBooleanDataField", (function () {
        return d.a
    })), n.d(e, "makeInt64DataField", (function () {
        return d.d
    })), n.d(e, "makeDoubleDataField", (function () {
        return d.b
    })), n.d(e, "makeStringDataField", (function () {
        return d.e
    })), n.d(e, "makeGuidDataField", (function () {
        return d.c
    }));
    var f = n(3);
    n.d(e, "DataFieldType", (function () {
        return f.a
    }));
    var l = n(14);
    n.d(e, "getEffectiveEventFlags", (function () {
        return l.a
    }));
    var v = n(5);
    n.d(e, "SamplingPolicy", (function () {
        return v.e
    })), n.d(e, "PersistencePriority", (function () {
        return v.d
    })), n.d(e, "CostPriority", (function () {
        return v.a
    })), n.d(e, "DataCategories", (function () {
        return v.b
    })), n.d(e, "DiagnosticLevel", (function () {
        return v.c
    }));
    var p = n(15);
    for (var u in p)["default", "Contracts", "ActivityScope", "addContractField", "getFieldsForContract", "DataClassification", "makeBooleanDataField", "makeInt64DataField", "makeDoubleDataField", "makeStringDataField", "makeGuidDataField", "DataFieldType", "getEffectiveEventFlags", "SamplingPolicy", "PersistencePriority", "CostPriority", "DataCategories", "DiagnosticLevel"].indexOf(u) < 0 && function (t) {
        n.d(e, t, (function () {
            return p[t]
        }))
    }(u);
    var y = n(1);
    n.d(e, "LogLevel", (function () {
        return y.b
    })), n.d(e, "Category", (function () {
        return y.a
    })), n.d(e, "onNotification", (function () {
        return y.e
    })), n.d(e, "logNotification", (function () {
        return y.d
    })), n.d(e, "logError", (function () {
        return y.c
    }));
    var h = n(8);
    n.d(e, "SuppressNexus", (function () {
        return h.b
    })), n.d(e, "SimpleTelemetryLogger", (function () {
        return h.a
    }));
    var g = n(16);
    n.d(e, "TelemetryLogger", (function () {
        return g.a
    }));
    var m = n(7);
    n.d(e, "cloneEvent", (function () {
        return m.a
    }));
    var b = n(17);
    for (var u in b)["default", "Contracts", "ActivityScope", "addContractField", "getFieldsForContract", "DataClassification", "makeBooleanDataField", "makeInt64DataField", "makeDoubleDataField", "makeStringDataField", "makeGuidDataField", "DataFieldType", "getEffectiveEventFlags", "SamplingPolicy", "PersistencePriority", "CostPriority", "DataCategories", "DiagnosticLevel", "LogLevel", "Category", "onNotification", "logNotification", "logError", "SuppressNexus", "SimpleTelemetryLogger", "TelemetryLogger", "cloneEvent"].indexOf(u) < 0 && function (t) {
        n.d(e, t, (function () {
            return b[t]
        }))
    }(u);
    var F = n(18);
    for (var u in F)["default", "Contracts", "ActivityScope", "addContractField", "getFieldsForContract", "DataClassification", "makeBooleanDataField", "makeInt64DataField", "makeDoubleDataField", "makeStringDataField", "makeGuidDataField", "DataFieldType", "getEffectiveEventFlags", "SamplingPolicy", "PersistencePriority", "CostPriority", "DataCategories", "DiagnosticLevel", "LogLevel", "Category", "onNotification", "logNotification", "logError", "SuppressNexus", "SimpleTelemetryLogger", "TelemetryLogger", "cloneEvent"].indexOf(u) < 0 && function (t) {
        n.d(e, t, (function () {
            return F[t]
        }))
    }(u)
}, function (t, e, n) {
    "use strict";
    n.d(e, "a", (function () {
        return i
    }));
    var r = n(2);

    function i(t, e, n) {
        var i = n.map((function (e) {
            return {
                name: t + "." + e.name,
                value: e.value,
                dataType: e.dataType
            }
        }));
        return Object(r.a)(i, t, e), i
    }
}, function (t, e) {}, function (t, e, n) {
    "use strict";
    n.d(e, "a", (function () {
        return o
    }));
    var r = n(5),
        i = n(1);

    function o(t) {
        var e = {
            costPriority: r.a.Normal,
            samplingPolicy: r.e.Measure,
            persistencePriority: r.d.Normal,
            dataCategories: r.b.NotSet,
            diagnosticLevel: r.c.FullEvent
        };
        return t.eventFlags && t.eventFlags.dataCategories || Object(i.d)(i.b.Error, i.a.Core, (function () {
            return "Event is missing DataCategories event flag"
        })), t.eventFlags ? (t.eventFlags.costPriority && (e.costPriority = t.eventFlags.costPriority), t.eventFlags.samplingPolicy && (e.samplingPolicy = t.eventFlags.samplingPolicy), t.eventFlags.persistencePriority && (e.persistencePriority = t.eventFlags.persistencePriority), t.eventFlags.dataCategories && (e.dataCategories = t.eventFlags.dataCategories), t.eventFlags.diagnosticLevel && (e.diagnosticLevel = t.eventFlags.diagnosticLevel), e) : e
    }
}, function (t, e) {}, function (t, e, n) {
    "use strict";
    n.d(e, "a", (function () {
        return d
    }));
    var r, i = n(8),
        o = n(9),
        a = n(6),
        c = (r = function (t, e) {
            return (r = Object.setPrototypeOf || {
                    __proto__: []
                }
                instanceof Array && function (t, e) {
                    t.__proto__ = e
                } || function (t, e) {
                    for (var n in e) e.hasOwnProperty(n) && (t[n] = e[n])
                })(t, e)
        }, function (t, e) {
            function n() {
                this.constructor = t
            }
            r(t, e), t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
        }),
        s = function (t, e, n, r) {
            return new(n || (n = Promise))((function (i, o) {
                function a(t) {
                    try {
                        s(r.next(t))
                    } catch (t) {
                        o(t)
                    }
                }

                function c(t) {
                    try {
                        s(r.throw(t))
                    } catch (t) {
                        o(t)
                    }
                }

                function s(t) {
                    var e;
                    t.done ? i(t.value) : (e = t.value, e instanceof n ? e : new n((function (t) {
                        t(e)
                    }))).then(a, c)
                }
                s((r = r.apply(t, e || [])).next())
            }))
        },
        u = function (t, e) {
            var n, r, i, o, a = {
                label: 0,
                sent: function () {
                    if (1 & i[0]) throw i[1];
                    return i[1]
                },
                trys: [],
                ops: []
            };
            return o = {
                next: c(0),
                throw: c(1),
                return: c(2)
            }, "function" == typeof Symbol && (o[Symbol.iterator] = function () {
                return this
            }), o;

            function c(o) {
                return function (c) {
                    return function (o) {
                        if (n) throw new TypeError("Generator is already executing.");
                        for (; a;) try {
                            if (n = 1, r && (i = 2 & o[0] ? r.return : o[0] ? r.throw || ((i = r.return) && i.call(r), 0) : r.next) && !(i = i.call(r, o[1])).done) return i;
                            switch (r = 0, i && (o = [2 & o[0], i.value]), o[0]) {
                                case 0:
                                case 1:
                                    i = o;
                                    break;
                                case 4:
                                    return a.label++, {
                                        value: o[1],
                                        done: !1
                                    };
                                case 5:
                                    a.label++, r = o[1], o = [0];
                                    continue;
                                case 7:
                                    o = a.ops.pop(), a.trys.pop();
                                    continue;
                                default:
                                    if (!(i = a.trys, (i = i.length > 0 && i[i.length - 1]) || 6 !== o[0] && 2 !== o[0])) {
                                        a = 0;
                                        continue
                                    }
                                    if (3 === o[0] && (!i || o[1] > i[0] && o[1] < i[3])) {
                                        a.label = o[1];
                                        break
                                    }
                                    if (6 === o[0] && a.label < i[1]) {
                                        a.label = i[1], i = o;
                                        break
                                    }
                                    if (i && a.label < i[2]) {
                                        a.label = i[2], a.ops.push(o);
                                        break
                                    }
                                    i[2] && a.ops.pop(), a.trys.pop();
                                    continue
                            }
                            o = e.call(t, a)
                        } catch (t) {
                            o = [6, t], r = 0
                        } finally {
                            n = i = 0
                        }
                        if (5 & o[0]) throw o[1];
                        return {
                            value: o[0] ? o[1] : void 0,
                            done: !0
                        }
                    }([o, c])
                }
            }
        },
        d = function (t) {
            function e() {
                return null !== t && t.apply(this, arguments) || this
            }
            return c(e, t), e.prototype.executeActivityAsync = function (t, e) {
                return s(this, void 0, void 0, (function () {
                    return u(this, (function (n) {
                        return [2, this.createNewActivity(t).executeAsync(e)]
                    }))
                }))
            }, e.prototype.executeActivitySync = function (t, e) {
                return this.createNewActivity(t).executeSync(e)
            }, e.prototype.createNewActivity = function (t) {
                return o.a.createNew(this, t)
            }, e.prototype.sendActivity = function (t, e, n, r) {
                return this.sendTelemetryEvent({
                    eventName: t,
                    eventContract: {
                        name: a.a.Office.System.Activity.contractName,
                        dataFields: a.a.Office.System.Activity.getFields(e)
                    },
                    dataFields: n,
                    eventFlags: r
                })
            }, e.prototype.sendError = function (t) {
                var e = a.a.Office.System.Error.getFields("Error", t.error);
                return null != t.dataFields && e.push.apply(e, t.dataFields), this.sendTelemetryEvent({
                    eventName: t.eventName,
                    dataFields: e,
                    eventFlags: t.eventFlags
                })
            }, e
        }(i.a)
}, function (t, e) {}, function (t, e) {}, function (t, e, n) {
    t.exports = n(11)
}]);



OSFPerformance.officeExecuteEnd = OSFPerformance.now();