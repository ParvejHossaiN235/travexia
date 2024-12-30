(() => {
  var t;
  (t = jQuery),
    window,
    t(document).ready(function () {
      const e = new Notyf({ ripple: !0, duration: 3e3, dismissable: !0, position: { x: "right", y: "bottom" } });
      t(document).on("submit", "form#tf-apartment-booking", function (a) {
        a.preventDefault();
        var o = t(this),
          n = new FormData(this);
        n.append("action", "tf_apartment_booking"),
          t.ajax({
            type: "post",
            url: tf_params.ajax_url,
            data: n,
            processData: !1,
            contentType: !1,
            beforeSend: function (e) {
              o.block({ message: null, overlayCSS: { background: "#fff", opacity: 0.5 } }), t(".tf-notice-wrapper").html("").hide();
            },
            complete: function (t) {
              o.unblock();
            },
            success: function (a) {
              o.unblock();
              var n = JSON.parse(a);
              if ("error" === n.status)
                return (
                  t.fancybox.close(),
                  n.errors &&
                    n.errors.forEach(function (t) {
                      e.error(t);
                    }),
                  !1
                );
              n.redirect_to ? window.location.replace(n.redirect_to) : jQuery(document.body).trigger("added_to_cart");
            },
            error: function (t) {
              console.log(t);
            },
          });
      }),
        t(document).on("submit", "#tf_apartment_booking", function (a) {
          a.preventDefault();
          let o = t(this),
            n = o.find(".tf-submit"),
            i = new FormData(o[0]);
          i.append("action", "tf_apartments_search"),
            i.append("_nonce", tf_params.nonce),
            (null != i.get("from") && null != i.get("to")) || (i.append("from", tf_params.tf_apartment_min_price), i.append("to", tf_params.tf_apartment_max_price)),
            t.ajax({
              url: tf_params.ajax_url,
              type: "POST",
              data: i,
              contentType: !1,
              processData: !1,
              beforeSend: function () {
                o.css({ opacity: "0.5", "pointer-events": "none" }), n.addClass("tf-btn-loading");
              },
              success: function (t) {
                let a = JSON.parse(t);
                o.css({ opacity: "1", "pointer-events": "all" }),
                  n.removeClass("tf-btn-loading"),
                  "error" === a.status && e.error(a.message),
                  "success" === a.status && (location.href = o.attr("action") + "?" + a.query_string);
              },
            });
        }),
        t(document).on("click", ".tf-apt-room-qv", function (e) {
          e.preventDefault(), t("#tour_room_details_loader").show();
          let a = t(this).data("post-id"),
            o = t(this).data("id"),
            n = { action: "tf_apt_room_details_qv", _nonce: tf_params.nonce, post_id: a, id: o };
          t.ajax({
            type: "post",
            url: tf_params.ajax_url,
            data: n,
            success: function (e) {
              t("#tf_apt_room_details_qv").html(e), t("#tour_room_details_loader").hide(), t.fancybox.open({ src: "#tf_apt_room_details_qv", type: "inline" });
            },
          });
        }),
        t(document).on("click", ".tf-apt-room-qv-desgin-1", function (e) {
          e.preventDefault(), t("#tour_room_details_loader").show();
          let a = t(this).data("post-id"),
            o = t(this).data("id"),
            n = { action: "tf_apt_room_details_qv", _nonce: tf_params.nonce, post_id: a, id: o };
          t.ajax({
            type: "post",
            url: tf_params.ajax_url,
            data: n,
            success: function (e) {
              t(".tf-room-popup").html(e), t(".tf-room-popup").addClass("tf-show"), t("#tour_room_details_loader").hide();
            },
          });
        });
      var a = document.getElementById("tf-apartment-location"),
        o = tf_params.apartment_locations;
      a &&
        (function (t, e) {
          var a;
          function o(t) {
            if (!t) return !1;
            !(function (t) {
              for (var e = 0; e < t.length; e++) t[e].classList.remove("autocomplete-active");
            })(t),
              a >= t.length && (a = 0),
              a < 0 && (a = t.length - 1),
              t[a].classList.add("autocomplete-active");
          }
          function n(e) {
            for (var a = document.getElementsByClassName("autocomplete-items"), o = 0; o < a.length; o++) e != a[o] && e != t && a[o].parentNode.removeChild(a[o]);
          }
          t.addEventListener("focus", function () {
            if ("" == this.value || !this.value) {
              let a = document.createElement("DIV");
              a.setAttribute("id", this.id + "autocomplete-list"), a.classList.add("autocomplete-items"), this.parentNode.appendChild(a);
              for (const [o, n] of Object.entries(e)) {
                let e = document.createElement("DIV");
                (e.innerHTML = n),
                  (e.innerHTML += `<input type='hidden' value="${n}" data-slug='${o}'>`),
                  e.addEventListener("click", function (e) {
                    let a = this.getElementsByTagName("input")[0];
                    (t.value = a.value), (t.closest("input").nextElementSibling.value = a.dataset.slug);
                  }),
                  a.appendChild(e);
              }
            }
          }),
            t.addEventListener("keyup", function (o) {
              var i,
                s,
                r = this.value;
              n(), (a = -1), (i = document.createElement("DIV")).setAttribute("id", this.id + "autocomplete-list"), i.setAttribute("class", "autocomplete-items"), this.parentNode.appendChild(i);
              var l = [];
              for (const [a, o] of Object.entries(e))
                o.substr(0, r.length).toUpperCase() == r.toUpperCase()
                  ? (l.push("found"),
                    ((s = document.createElement("DIV")).innerHTML = "<strong>" + o.substr(0, r.length) + "</strong>"),
                    (s.innerHTML += o.substr(r.length)),
                    (s.innerHTML += `<input type='hidden' value="${o}" data-slug='${a}'> `),
                    s.addEventListener("click", function (e) {
                      let a = this.getElementsByTagName("input")[0];
                      (t.value = a.value), (t.closest("input").nextElementSibling.value = a.dataset.slug), n();
                    }),
                    i.appendChild(s))
                  : l.push("notfound");
              -1 == l.indexOf("found") &&
                (((s = document.createElement("DIV")).innerHTML += tf_params.no_found),
                (s.innerHTML += "<input type='hidden' value=''>"),
                s.addEventListener("click", function (e) {
                  (t.value = this.getElementsByTagName("input")[0].value), n();
                }),
                i.appendChild(s));
            }),
            t.addEventListener("keydown", function (t) {
              var e = document.getElementById(this.id + "autocomplete-list");
              e && (e = e.getElementsByTagName("div")), 40 == t.keyCode ? (a++, o(e)) : 38 == t.keyCode ? (a--, o(e)) : 13 == t.keyCode && (t.preventDefault(), a > -1 && e && e[a].trigger("click"));
            }),
            document.addEventListener("click", function (t) {
              ("content" != t.target.id && "" != t.target.id) || n(t.target);
            });
        })(a, o),
        tf_params.tf_apartment_min_price >= 0 &&
          tf_params.tf_apartment_max_price > 0 &&
          t(".tf-apartment-filter-range").alRangeSlider({
            range: { min: parseInt(tf_params.tf_apartment_min_price), max: parseInt(tf_params.tf_apartment_max_price), step: 1 },
            initialSelectedValues: { from: parseInt(tf_params.tf_apartment_min_price), to: parseInt(tf_params.tf_apartment_max_price) },
            grid: !1,
            theme: "dark",
          }),
        t(".tf-apt-highlights-slider").slick({
          dots: !0,
          arrows: !1,
          infinite: !0,
          speed: 300,
          autoplay: !1,
          autoplaySpeed: 3e3,
          slidesToShow: 3,
          slidesToScroll: 1,
          responsive: [
            { breakpoint: 1024, settings: { slidesToShow: 2, slidesToScroll: 1, infinite: !0, dots: !0 } },
            { breakpoint: 600, settings: { slidesToShow: 2, slidesToScroll: 1 } },
            { breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1 } },
          ],
        }),
        t(".tf-apartment-room-slider").slick({
          dots: !0,
          arrows: !1,
          infinite: !0,
          speed: 300,
          autoplay: !1,
          autoplaySpeed: 3e3,
          slidesToShow: 3,
          slidesToScroll: 1,
          responsive: [
            { breakpoint: 1024, settings: { slidesToShow: 2, slidesToScroll: 1, infinite: !0, dots: !0 } },
            { breakpoint: 600, settings: { slidesToShow: 2, slidesToScroll: 1 } },
            { breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1 } },
          ],
        }),
        t(".tf-apartment-default-design-room-slider").slick({
          arrows: !0,
          infinite: !0,
          speed: 300,
          autoplay: !1,
          autoplaySpeed: 3e3,
          slidesToShow: 3,
          slidesToScroll: 1,
          prevArrow:
            '<button type=\'button\' class=\'slick-prev\'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">\n  <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2071 5.29289C16.5976 5.68342 16.5976 6.31658 16.2071 6.70711L10.9142 12L16.2071 17.2929C16.5976 17.6834 16.5976 18.3166 16.2071 18.7071C15.8166 19.0976 15.1834 19.0976 14.7929 18.7071L8.79289 12.7071C8.40237 12.3166 8.40237 11.6834 8.79289 11.2929L14.7929 5.29289C15.1834 4.90237 15.8166 4.90237 16.2071 5.29289Z" fill="#2A3343"/>\n</svg></button>',
          nextArrow:
            '<button type=\'button\' class=\'slick-next\'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">\n  <path fill-rule="evenodd" clip-rule="evenodd" d="M8.79289 5.29289C9.18342 4.90237 9.81658 4.90237 10.2071 5.29289L16.2071 11.2929C16.5976 11.6834 16.5976 12.3166 16.2071 12.7071L10.2071 18.7071C9.81658 19.0976 9.18342 19.0976 8.79289 18.7071C8.40237 18.3166 8.40237 17.6834 8.79289 17.2929L14.0858 12L8.79289 6.70711C8.40237 6.31658 8.40237 5.68342 8.79289 5.29289Z" fill="#2A3343"/>\n</svg></button>',
          responsive: [
            { breakpoint: 1024, settings: { slidesToShow: 2, slidesToScroll: 1, infinite: !0 } },
            { breakpoint: 600, settings: { slidesToShow: 2, slidesToScroll: 1 } },
            { breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1 } },
          ],
        }),
        t(".tf-related-apartment-slider").slick({
          dots: !0,
          arrows: !1,
          infinite: !0,
          speed: 300,
          autoplay: !0,
          autoplaySpeed: 3e3,
          slidesToShow: 4,
          slidesToScroll: 1,
          responsive: [
            { breakpoint: 1024, settings: { slidesToShow: 3, slidesToScroll: 1, infinite: !0, dots: !0 } },
            { breakpoint: 600, settings: { slidesToShow: 2, slidesToScroll: 1 } },
            { breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1 } },
          ],
        }),
        t(".tf-features-block-slides").slick({
          dots: !0,
          arrows: !1,
          infinite: !0,
          speed: 300,
          autoplay: !1,
          autoplaySpeed: 2e3,
          slidesToShow: 4,
          slidesToScroll: 1,
          responsive: [
            { breakpoint: 1024, settings: { slidesToShow: 2, slidesToScroll: 1 } },
            { breakpoint: 600, settings: { slidesToShow: 2, slidesToScroll: 1 } },
            { breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1 } },
          ],
        }),
        t(document).on("click", ".tf-apartment-show-more", function (e) {
          t(this).siblings(".tf-full-description") &&
            (t(this).siblings(".tf-full-description").show(), t(this).siblings(".tf-description").hide(), t(this).text("Show Less"), t(this).addClass("tf-apartment-show-less"));
        }),
        t(document).on("click", ".tf-apartment-show-less", function (e) {
          t(this).siblings(".tf-full-description") &&
            (t(this).siblings(".tf-full-description").hide(), t(this).siblings(".tf-description").show(), t(this).text("Show More"), t(this).removeClass("tf-apartment-show-less"));
        }),
        t(".tf-single-review.tf_apartment .tf-single-details").each(function (e, a) {
          e > 1 && t(this).hide();
        }),
        t(".tf-apaartment-show-all").on("click", function (e) {
          t(".tf-single-review.tf_apartment .tf-single-details").each(function (e, a) {
            t(a).show();
          });
        });
    }),
    (function (t, e) {
      t(document).ready(function () {
        const e = new Notyf({ ripple: !0, duration: 3e3, dismissable: !0, position: { x: "right", y: "bottom" } });
        function a(t, e) {
          var a;
          function o(t) {
            if (!t) return !1;
            !(function (t) {
              for (var e = 0; e < t.length; e++) t[e].classList.remove("autocomplete-active");
            })(t),
              a >= t.length && (a = 0),
              a < 0 && (a = t.length - 1),
              t[a].classList.add("autocomplete-active");
          }
          function n(e) {
            for (var a = document.getElementsByClassName("autocomplete-items"), o = 0; o < a.length; o++) e != a[o] && e != t && a[o].parentNode.removeChild(a[o]);
          }
          t.addEventListener("focus", function () {
            if ("" == this.value || !this.value) {
              let a = document.createElement("DIV");
              a.setAttribute("id", this.id + "autocomplete-list"), a.classList.add("autocomplete-items"), this.parentNode.appendChild(a);
              for (const [o, n] of Object.entries(e)) {
                let e = document.createElement("DIV");
                (e.innerHTML = n),
                  (e.innerHTML += `<input type='hidden' value="${n}" data-slug='${o}'>`),
                  e.addEventListener("click", function (e) {
                    let a = this.getElementsByTagName("input")[0];
                    (t.value = a.value), (t.closest("input").nextElementSibling.value = a.dataset.slug);
                  }),
                  a.appendChild(e);
              }
            }
          }),
            t.addEventListener("keyup", function (o) {
              var i,
                s,
                r = this.value;
              n(), (a = -1), (i = document.createElement("DIV")).setAttribute("id", this.id + "autocomplete-list"), i.setAttribute("class", "autocomplete-items"), this.parentNode.appendChild(i);
              var l = [];
              for (const [a, o] of Object.entries(e))
                o.substr(0, r.length).toUpperCase() == r.toUpperCase()
                  ? (l.push("found"),
                    ((s = document.createElement("DIV")).innerHTML = "<strong>" + o.substr(0, r.length) + "</strong>"),
                    (s.innerHTML += o.substr(r.length)),
                    (s.innerHTML += `<input type='hidden' value="${o}" data-slug='${a}'> `),
                    s.addEventListener("click", function (e) {
                      let a = this.getElementsByTagName("input")[0];
                      (t.value = a.value), (t.closest("input").nextElementSibling.value = a.dataset.slug), n();
                    }),
                    i.appendChild(s))
                  : l.push("notfound");
              -1 == l.indexOf("found") &&
                (((s = document.createElement("DIV")).innerHTML += tf_params.no_found),
                (s.innerHTML += "<input type='hidden' value=''>"),
                s.addEventListener("click", function (e) {
                  (t.value = this.getElementsByTagName("input")[0].value), n();
                }),
                i.appendChild(s));
            }),
            t.addEventListener("keydown", function (t) {
              var e = document.getElementById(this.id + "autocomplete-list");
              e && (e = e.getElementsByTagName("div")), 40 == t.keyCode ? (a++, o(e)) : 38 == t.keyCode ? (a--, o(e)) : 13 == t.keyCode && (t.preventDefault(), a > -1 && e && e[a].trigger("click"));
            }),
            document.addEventListener("click", function (t) {
              ("content" != t.target.id && "" != t.target.id) || n(t.target);
            });
        }
        t(".tf-car-faq-section .tf-faq-head").on("click", function () {
          var e = t(this);
          e.hasClass("active") || (t(".tf-question-desc").slideUp(400), t(".tf-faq-head").removeClass("active"), t(".tf-faq-col").removeClass("active")),
            e.toggleClass("active"),
            e.next().slideToggle(),
            t(this).closest(".tf-faq-col").toggleClass("active");
        }),
          t(".tf-details-menu ul li").on("click", function () {
            var e = t(this);
            ($currentmenu = e.attr("data-menu")), t(".tf-details-menu ul li").removeClass("active"), t('.tf-details-menu ul li[data-menu="' + $currentmenu + '"]').addClass("active");
          });
        var o = document.getElementById("tf_pickup_location"),
          n = tf_params.car_locations;
        o && a(o, n);
        var i = document.getElementById("tf_dropoff_location");
        i && a(i, n),
          t(document).on("click", ".tf-booking-popup-header .tf-close-popup", function (e) {
            e.preventDefault(), t(".tf-car-booking-popup").hide();
          }),
          t(document).on("click", ".tf-car-booking", function (e) {
            e.preventDefault(), ($this = t(this)), t(".tf-booking-content-wraper").html("");
            var a = t("#tf_pickup_location").val();
            let o = t("#tf_dropoff_location").val(),
              n = t(".tf_pickup_date").val(),
              i = t(".tf_dropoff_date").val(),
              s = t(".tf_pickup_time").val(),
              r = t(".tf_dropoff_time").val(),
              l = t("#post_id").val();
            if (!(a && o && n && i && s && r)) return t(".error-notice").show(), void t(".error-notice").text("Fill up the all fields");
            $this.attr("data-partial") && t("#tf_partial_payment").val($this.attr("data-partial"));
            var c = { action: "tf_car_booking_pupup", _nonce: tf_params.nonce, post_id: l, pickup_date: n, pickup_time: s, dropoff_date: i, dropoff_time: r };
            t.ajax({
              url: tf_params.ajax_url,
              type: "POST",
              data: c,
              beforeSend: function () {
                $this.addClass("tf-btn-loading");
              },
              success: function (e) {
                t(".tf-booking-content-wraper").html(e), t(".error-notice").hide(), t(".tf-car-booking-popup").css("display", "flex"), $this.removeClass("tf-btn-loading");
              },
            });
          }),
          t(document).on("click", ".tf-car-quick-booking", function (e) {
            e.preventDefault(), ($this = t(this)), t(".tf-booking-content-wraper").html("");
            let a = $this.closest(".tf-booking-btn").find("#post_id").val(),
              o = $this.closest(".tf-booking-btn").find("#pickup_date").val(),
              n = $this.closest(".tf-booking-btn").find("#dropoff_date").val(),
              i = $this.closest(".tf-booking-btn").find("#pickup_time").val(),
              s = $this.closest(".tf-booking-btn").find("#dropoff_time").val();
            var r = { action: "tf_car_booking_pupup", _nonce: tf_params.nonce, post_id: a, pickup_date: o, pickup_time: i, dropoff_date: n, dropoff_time: s };
            t.ajax({
              url: tf_params.ajax_url,
              type: "POST",
              data: r,
              beforeSend: function () {
                $this.addClass("tf-btn-loading");
              },
              success: function (t) {
                $this.closest(".tf-booking-btn").find(".tf-booking-content-wraper").html(t),
                  $this.closest(".tf-booking-btn").find(".tf-car-booking-popup").css("display", "flex"),
                  $this.removeClass("tf-btn-loading");
              },
            });
          }),
          t(document).on("click", ".booking-next", function (e) {
            t(this),
              t(".tf-booking-tabs ul li").removeClass("active"),
              t(".tf-booking-tabs ul li.booking").addClass("active"),
              t(".tf-protection-content").hide(),
              t(".tf-booking-bar").hide(),
              t(".tf-booking-form-fields").show();
          });
        const s = (e) => {
          let a = [];
          if (
            (t(".error-text").text(""),
            e.find(".tf-single-field").each(function () {
              t(this)
                .find("input, select")
                .each(function () {
                  if (t(this).attr("data-required") && "" == t(this).val()) {
                    a.push(!0);
                    const e = t(this).siblings(".error-text");
                    e.text("This field is required."), "" !== e.text() ? e.addClass("error-visible") : e.removeClass("error-visible");
                  }
                }),
                t(this)
                  .find('input[type="radio"], input[type="checkbox"]')
                  .each(function () {
                    if (t(this).attr("data-required")) {
                      const e = t(this).attr("name");
                      if (!(t('input[name="' + e + '"]:checked').length > 0)) {
                        a.push(!0);
                        const e = t(this).parent().siblings(".error-text");
                        e.text("This field is required."), "" !== e.text() ? e.addClass("error-visible") : e.removeClass("error-visible");
                      }
                    }
                  });
            }),
            a.includes(!0))
          )
            return !0;
        };
        t(document).on("click", ".tf-car-booking-form .booking-process", function (a) {
          let o = t(this),
            n = t("input[name='selected_extra[]']")
              .map(function () {
                return t(this).val();
              })
              .get(),
            i = t("input[name='selected_qty[]']")
              .map(function () {
                return t(this).val();
              })
              .get();
          var r = {};
          if (o.hasClass("tf-offline-booking")) {
            let e = t(this).closest(".tf-booking-form-fields");
            if (s(e)) return;
            t("input[name^='traveller[']").each(function () {
              var e = t(this)
                .attr("name")
                .replace(/^traveller\[(.*)\]$/, "$1");
              r[e] = t(this).val();
            }),
              t("select[name^='traveller[']").each(function () {
                var e = t(this)
                  .attr("name")
                  .replace(/^traveller\[(.*)\]$/, "$1");
                r[e] = t(this).val();
              }),
              t("input[type='checkbox'][name^='traveller[']:checked, input[type='radio'][name^='traveller[']:checked").each(function () {
                var e = t(this)
                  .attr("name")
                  .replace(/^traveller\[(.*)\]$/, "$1");
                r[e] || (r[e] = []), r[e].push(t(this).val());
              });
          }
          if (o.hasClass("tf-final-step")) {
            var l = t("#tf_pickup_location").val();
            let e = t("#tf_dropoff_location").val(),
              a = t(".tf_pickup_date").val(),
              o = t(".tf_dropoff_date").val(),
              n = t(".tf_pickup_time").val(),
              i = t(".tf_dropoff_time").val();
            if (!(l && e && a && o && n && i)) return t(".error-notice").show(), void t(".error-notice").text("Fill up the all fields");
          }
          t(".error-notice").hide(), (l = t("#tf_pickup_location").val());
          let c = t("#tf_dropoff_location").val(),
            f = t(".tf_pickup_date").val(),
            d = t(".tf_dropoff_date").val(),
            p = t(".tf_pickup_time").val(),
            u = t(".tf_dropoff_time").val(),
            m = t("#post_id").val();
          var h = t('input[name="protections[]"]:checked')
            .map(function () {
              return t(this).val();
            })
            .get();
          let _ = t("#tf_partial_payment").val();
          var g = {
            action: "tf_car_booking",
            _nonce: tf_params.nonce,
            post_id: m,
            pickup: l,
            dropoff: c,
            pickup_date: f,
            dropoff_date: d,
            pickup_time: p,
            dropoff_time: u,
            protection: h,
            partial_payment: _,
            extra_ids: n,
            extra_qty: i,
            travellerData: r,
          };
          t.ajax({
            url: tf_params.ajax_url,
            type: "POST",
            data: g,
            beforeSend: function () {
              o.addClass("tf-btn-loading");
            },
            success: function (a) {
              o.unblock();
              var n = JSON.parse(a);
              if ("error" == n.status)
                return (
                  n.errors &&
                    n.errors.forEach(function (t) {
                      e.error(t);
                    }),
                  t(".tf-car-booking-popup").hide(),
                  o.removeClass("tf-btn-loading"),
                  t(".tf-protection-content")
                    ? (t(".tf-protection-content").show(),
                      t(".tf-booking-bar").show(),
                      t(".tf-booking-form-fields").hide(),
                      t(".tf-booking-tabs ul li").removeClass("active"),
                      t(".tf-booking-tabs ul li.protection").addClass("active"))
                    : (t(".tf-booking-form-fields").show(), t(".tf-booking-tabs ul li").removeClass("active"), t(".tf-booking-tabs ul li.booking").addClass("active")),
                  !1
                );
              if ("false" == n.without_payment) {
                if ("error" == n.status)
                  return (
                    n.errors &&
                      n.errors.forEach(function (t) {
                        e.error(t);
                      }),
                    !1
                  );
                n.redirect_to ? window.location.replace(n.redirect_to) : jQuery(document.body).trigger("added_to_cart");
              } else
                t(".tf-car-booking-popup").hide(),
                  t(".tf-withoutpayment-booking-confirm").addClass("show"),
                  o.removeClass("tf-btn-loading"),
                  t("#tf_pickup_location").val(""),
                  t("#tf_dropoff_location").val(""),
                  t(".tf_pickup_date").val(""),
                  t(".tf_dropoff_date").val(""),
                  t(".tf_pickup_time").val(""),
                  t(".tf_dropoff_time").val(""),
                  t(".tf-protection-content")
                    ? (t(".tf-protection-content").show(),
                      t(".tf-booking-bar").show(),
                      t(".tf-booking-form-fields").hide(),
                      t(".tf-booking-tabs ul li").removeClass("active"),
                      t(".tf-booking-tabs ul li.protection").addClass("active"))
                    : (t(".tf-booking-form-fields").show(), t(".tf-booking-tabs ul li").removeClass("active"), t(".tf-booking-tabs ul li.booking").addClass("active"));
            },
          });
        }),
          t(document).on("submit", "#tf_car_booking", function (a) {
            a.preventDefault();
            let o = t(this),
              n = o.find(".tf-submit"),
              i = new FormData(o[0]);
            i.append("action", "tf_car_search"),
              i.append("_nonce", tf_params.nonce),
              (null != i.get("from") && null != i.get("to")) || (i.append("from", tf_params.tf_car_min_price), i.append("to", tf_params.tf_car_max_price)),
              t.ajax({
                url: tf_params.ajax_url,
                type: "POST",
                data: i,
                contentType: !1,
                processData: !1,
                beforeSend: function () {
                  o.css({ opacity: "0.5", "pointer-events": "none" }), n.addClass("tf-btn-loading");
                },
                success: function (t) {
                  let a = JSON.parse(t);
                  o.css({ opacity: "1", "pointer-events": "all" }),
                    n.removeClass("tf-btn-loading"),
                    "error" === a.status && e.error(a.message),
                    "success" === a.status && (location.href = o.attr("action") + "?" + a.query_string);
                },
              });
          }),
          t(document).on("click", ".quick-booking", function (a) {
            let o = t(this);
            var n = t("#tf_pickup_location").val();
            let i = t("#tf_dropoff_location").val(),
              s = o.closest(".tf-booking-btn").find("#pickup_date").val(),
              r = o.closest(".tf-booking-btn").find("#dropoff_date").val(),
              l = o.closest(".tf-booking-btn").find("#pickup_time").val(),
              c = o.closest(".tf-booking-btn").find("#dropoff_time").val(),
              f = o.closest(".tf-booking-btn").find("#post_id").val();
            var d = { action: "tf_car_booking", _nonce: tf_params.nonce, post_id: f, pickup: n, dropoff: i, pickup_date: s, dropoff_date: r, pickup_time: l, dropoff_time: c };
            t.ajax({
              url: tf_params.ajax_url,
              type: "POST",
              data: d,
              beforeSend: function () {
                o.addClass("tf-btn-loading");
              },
              success: function (t) {
                o.unblock();
                var a = JSON.parse(t);
                if ("false" == a.without_payment) {
                  if ("error" == a.status)
                    return (
                      a.errors &&
                        a.errors.forEach(function (t) {
                          e.error(t);
                        }),
                      !1
                    );
                  a.redirect_to ? window.location.replace(a.redirect_to) : jQuery(document.body).trigger("added_to_cart");
                }
              },
            });
          }),
          t(document).on("click", ".tf-booking-btn .booking-process", function (a) {
            let o = t(this);
            var n = {};
            if (o.hasClass("tf-offline-booking")) {
              let e = t(this).closest(".tf-booking-form-fields");
              if (s(e)) return;
              t("input[name^='traveller[']").each(function () {
                var e = t(this)
                  .attr("name")
                  .replace(/^traveller\[(.*)\]$/, "$1");
                n[e] = t(this).val();
              }),
                t("select[name^='traveller[']").each(function () {
                  var e = t(this)
                    .attr("name")
                    .replace(/^traveller\[(.*)\]$/, "$1");
                  n[e] = t(this).val();
                }),
                t("input[type='checkbox'][name^='traveller[']:checked, input[type='radio'][name^='traveller[']:checked").each(function () {
                  var e = t(this)
                    .attr("name")
                    .replace(/^traveller\[(.*)\]$/, "$1");
                  n[e] || (n[e] = []), n[e].push(t(this).val());
                });
            }
            var i = t("#tf_pickup_location").val();
            let r = t("#tf_dropoff_location").val(),
              l = t("#tf_partial_payment").val(),
              c = o.closest(".tf-booking-btn").find("#pickup_date").val(),
              f = o.closest(".tf-booking-btn").find("#dropoff_date").val(),
              d = o.closest(".tf-booking-btn").find("#pickup_time").val(),
              p = o.closest(".tf-booking-btn").find("#dropoff_time").val(),
              u = o.closest(".tf-booking-btn").find("#post_id").val();
            var m = t('input[name="protections[]"]:checked')
                .map(function () {
                  return t(this).val();
                })
                .get(),
              h = {
                action: "tf_car_booking",
                _nonce: tf_params.nonce,
                post_id: u,
                pickup: i,
                dropoff: r,
                pickup_date: c,
                dropoff_date: f,
                pickup_time: d,
                dropoff_time: p,
                protection: m,
                partial_payment: l,
                travellerData: n,
              };
            t.ajax({
              url: tf_params.ajax_url,
              type: "POST",
              data: h,
              beforeSend: function () {
                o.addClass("tf-btn-loading");
              },
              success: function (a) {
                o.unblock();
                var n = JSON.parse(a);
                if ("error" == n.status)
                  return (
                    n.errors &&
                      n.errors.forEach(function (t) {
                        e.error(t);
                      }),
                    t(".tf-car-booking-popup").hide(),
                    o.removeClass("tf-btn-loading"),
                    !1
                  );
                if ("false" == n.without_payment) {
                  if ("error" == n.status)
                    return (
                      n.errors &&
                        n.errors.forEach(function (t) {
                          e.error(t);
                        }),
                      !1
                    );
                  n.redirect_to ? window.location.replace(n.redirect_to) : jQuery(document.body).trigger("added_to_cart");
                } else t(".tf-car-booking-popup").hide(), t(".tf-withoutpayment-booking-confirm").addClass("show"), o.removeClass("tf-btn-loading");
              },
            });
          }),
          t(document).on(
            "change",
            ".tf-car-booking-form .tf_pickup_date, .tf-car-booking-form .tf_pickup_time, .tf-car-booking-form .tf_dropoff_date, .tf-car-booking-form .tf_dropoff_time",
            function (e) {
              let a = t("input[name='selected_extra[]']")
                  .map(function () {
                    return t(this).val();
                  })
                  .get(),
                o = t("input[name='selected_qty[]']")
                  .map(function () {
                    return t(this).val();
                  })
                  .get(),
                n = t(".tf_pickup_date").val(),
                i = t(".tf_dropoff_date").val(),
                s = t(".tf_pickup_time").val(),
                r = t(".tf_dropoff_time").val(),
                l = t("#post_id").val();
              if (n && i && s && r) {
                var c = { action: "tf_car_price_calculation", _nonce: tf_params.nonce, post_id: l, pickup_date: n, dropoff_date: i, pickup_time: s, dropoff_time: r, extra_ids: a, extra_qty: o };
                t.ajax({
                  url: tf_params.ajax_url,
                  type: "POST",
                  data: c,
                  beforeSend: function () {
                    t(".tf-date-select-box").addClass("tf-box-loading");
                  },
                  success: function (e) {
                    t(".tf-cancellation-box").html(""),
                      t(".tf-cancellation-box").hide(),
                      e &&
                        (e.data.total_price && t(".tf-price-header h2").html(e.data.total_price),
                        e.data.cancellation && (t(".tf-cancellation-box").html(e.data.cancellation), t(".tf-cancellation-box").show()),
                        t(".tf-date-select-box").removeClass("tf-box-loading"));
                  },
                });
              }
            }
          ),
          t(document).on("click", ".tf-archive-header .tf-archive-view ul li", function (e) {
            t(".tf-archive-header .tf-archive-view ul li").removeClass("active");
            let a = t(this);
            a.addClass("active");
            let o = a.attr("data-view");
            "grid" == o
              ? (console.log(o),
                t(".tf-car-details-column .tf-car-archive-result .tf-car-result").removeClass("list-view"),
                t(".tf-car-details-column .tf-car-archive-result .tf-car-result").addClass("grid-view"))
              : (t(".tf-car-details-column .tf-car-archive-result .tf-car-result").addClass("list-view"), t(".tf-car-details-column .tf-car-archive-result .tf-car-result").removeClass("grid-view"));
          }),
          t(".tf-single-car-details-warper .tf-details-menu").length &&
            t(window).scroll(function () {
              var e = t(".tf-single-car-details-warper .tf-details-menu").offset().top + t(".tf-single-car-details-warper .tf-details-menu").outerHeight();
              t(window).scrollTop() > e ? t(".tf-single-booking-bar").fadeIn() : t(".tf-single-booking-bar").fadeOut();
            }),
          t(document).on("click", ".tf-back-to-booking", function (e) {
            e.preventDefault(), t(".tf-single-booking-bar").fadeOut();
            var a = t(".tf-single-booking-bar").outerHeight() || 0;
            t("html, body").animate({ scrollTop: t(".tf-date-select-box").offset().top - a });
          }),
          t(".tf-single-car-section .tf-share-toggle").on("click", function (e) {
            e.preventDefault(), t(".tf-share-toggle").toggleClass("actives"), t(".share-car-content").toggleClass("show");
          }),
          t(document).on("click", ".tf-instraction-showing", function (e) {
            t(".tf-car-instraction-popup").css("display", "flex");
          }),
          t(document).on("click", ".tf-instraction-popup-header .tf-close-popup", function (e) {
            e.preventDefault(), t(".tf-car-instraction-popup").hide();
          }),
          t(document).on("change", ".protection-checkbox", function (e) {
            let a = 0,
              o = parseFloat(t("#tf_total_proteciton_price").val()) || 0,
              n = parseFloat(t(this).parent().parent().find("#tf_single_protection_price").val()) || 0;
            (a = t(this).is(":checked") ? o + n : o - n), t("#tf_total_proteciton_price").val(a.toFixed(2)), t("#tf_proteciton_subtotal").text(a.toFixed(2));
          }),
          t(document).on("click", ".tf-mobile-booking-btn button", function (e) {
            e.preventDefault();
            var a = t(this);
            t(".tf-date-select-box").slideToggle(function () {
              t(this).is(":visible") ? a.text("Hide") : a.text("Book Now");
            });
          });
      });
    })(jQuery, window),
    (function (t, e) {
      t(document).ready(function () {
        const e = new Notyf({ ripple: !0, duration: 3e3, dismissable: !0, position: { x: "right", y: "bottom" } }),
          a = () => {
            var a = t("#adults").attr("type"),
              o = t("#children").attr("type");
            if ("" != t.trim(t("input[name=check-in-out-date]").val())) {
              1 === t("#tf-required").length &&
                ("design-3" == tf_params.hotel_single_template
                  ? (t(".tf_booking-dates .tf_label-row").removeClass("tf-date-required"), t(".tf-hotel-error-msg").hide())
                  : t(".tf_booking-dates .tf_label-row .required").html(""));
              var n = [];
              t(".tf-room-checkbox :checkbox:checked").each(function (e) {
                n[e] = t(this).val();
              });
              var i = t("input[name=tf_room_avail_nonce]").val(),
                s = t("input[name=post_id]").val();
              if ("number" == a || "tel" == a) var r = t("#adults").val();
              else r = t("select[name=adults] option").filter(":selected").val();
              if ("number" == o || "tel" == o) var l = t("#children").val();
              else l = t("select[name=children] option").filter(":selected").val();
              var c = t("input[name=children_ages]").val(),
                f = t("input[name=check-in-out-date]").val(),
                d = { action: "tf_room_availability", tf_room_avail_nonce: i, post_id: s, adult: r, child: l, features: n, children_ages: c, check_in_out: f };
              jQuery.ajax({
                url: tf_params.ajax_url,
                type: "post",
                data: d,
                beforeSend: function () {
                  t("#tf-single-hotel-avail .btn-primary.tf-submit").addClass("tf-btn-booking-loading");
                },
                success: function (a) {
                  t("#rooms").length > 0
                    ? (t("html, body").animate({ scrollTop: t("#rooms").offset().top }, 500),
                      t("#rooms").html(a),
                      t(".tf-room-filter").show(),
                      t("#tf-single-hotel-avail .btn-primary.tf-submit").removeClass("tf-btn-booking-loading"))
                    : (e.error(tf_params.no_room_found), t("#tf-single-hotel-avail .btn-primary.tf-submit").removeClass("tf-btn-booking-loading"));
                },
                error: function (t) {
                  console.log(t);
                },
              });
            } else
              0 === t("#tf-required").length &&
                (1 === t(".tf_booking-dates .tf_label-row").length
                  ? "design-3" == tf_params.hotel_single_template
                    ? (t(".tf_booking-dates .tf_label-row").addClass("tf-date-required"), t(".tf-hotel-error-msg").show())
                    : t(".tf_booking-dates .tf_label-row").append('<span id="tf-required" class="required"><b>' + tf_params.field_required + "</b></span>")
                  : t(".tf-check-in-out-date").trigger("click"));
          };
        t(document).on("change", "input[name=check-in-out-date]", function () {
          "design-3" == tf_params.hotel_single_template &&
            ("" !== t.trim(t("input[name=check-in-out-date]").val())
              ? (t(".tf_booking-dates .tf_label-row").removeClass("tf-date-required"), t(".tf-hotel-error-msg").hide())
              : (t(".tf_booking-dates .tf_label-row").addClass("tf-date-required"), t(".tf-hotel-error-msg").show()));
        }),
          t(document).on("click", "#tf-single-hotel-avail .tf-submit", function (t) {
            t.preventDefault(), a();
          }),
          t(document).on("change", ".tf-room-checkbox :checkbox", function () {
            a();
          }),
          t(document).on("click", ".hotel-room-availability", function (e) {
            e.preventDefault(), t("html, body").animate({ scrollTop: t("#tf-single-hotel-avail").offset().top }, 500);
          }),
          t(document).on("click", ".hotel-room-book", function (a) {
            a.preventDefault();
            var o = t(this),
              n = t("input[name=tf_room_booking_nonce]").val(),
              i = t("input[name=post_id]").val(),
              s = o.closest(".tf-room").find("input[name=unique_id]").val(),
              r = o.closest(".tf-room").find("input[name=room_id]").val(),
              l = o.closest(".tf-room").find("input[name=option_id]").val(),
              c = t("input[name=place]").val(),
              f = t("input[name=adult]").val(),
              d = t("input[name=child]").val(),
              p = t("input[name=children_ages]").val(),
              u = t("input[name=check_in_date]").val(),
              m = t("input[name=check_out_date]").val();
            if (t(this).closest(".reserve").find("select[name=hotel_room_selected] option").filter(":selected").val())
              var h = t(this).closest(".reserve").find("select[name=hotel_room_selected] option").filter(":selected").val(),
                _ = t(this).closest(".room-submit-wrap").find("input[name=make_deposit]").is(":checked");
            else (h = t("#hotel_room_number").val()), (_ = t("#hotel_room_depo").val());
            var g = {
              action: "tf_hotel_booking",
              tf_room_booking_nonce: n,
              post_id: i,
              room_id: r,
              unique_id: s,
              option_id: l,
              location: c,
              adult: f,
              child: d,
              children_ages: p,
              check_in_date: u,
              check_out_date: m,
              room: h,
              deposit: _,
              airport_service: o.closest(".tf-withoutpayment-popup").find('[name="airport_service"]:checked').val(),
            };
            o
              .closest(".tf-booking-pagination")
              .siblings(".tf-booking-content-summery")
              .find(".traveller-single-info input")
              .each(function (e, a) {
                var o = t(a).attr("name");
                g[o] = t(a).val();
              }),
              t.ajax({
                type: "post",
                url: tf_params.ajax_url,
                data: g,
                beforeSend: function (e) {
                  o.block({ message: null, overlayCSS: { background: "#fff", opacity: 0.5 } }), t(".tf_notice_wrapper").html("").hide();
                },
                complete: function (t) {
                  o.unblock();
                },
                success: function (a) {
                  o.unblock();
                  var n = JSON.parse(a);
                  if ("error" == n.status)
                    return (
                      n.errors &&
                        n.errors.forEach(function (t) {
                          e.error(t);
                        }),
                      !1
                    );
                  n.redirect_to ? window.location.replace(n.redirect_to) : (jQuery(document.body).trigger("added_to_cart"), t.fancybox.close());
                },
                error: function (t) {
                  console.log(t);
                },
              });
          }),
          t('[data-fancybox="hotel-gallery"]').fancybox({ loop: !0, buttons: ["zoom", "slideShow", "fullScreen", "close"], hash: !1 });
        var o = t(".swiper-button-prev"),
          n = t(".swiper-button-next");
        t(".single-slider-wrapper .tf_slider-for").slick({
          slide: ".slick-slide-item",
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: !1,
          fade: !1,
          dots: !1,
          centerMode: !1,
          variableWidth: !1,
          adaptiveHeight: !0,
        }),
          o.on("click", function () {
            t(this).closest(".single-slider-wrapper").find(".tf_slider-for").slick("slickPrev");
          }),
          n.on("click", function () {
            t(this).closest(".single-slider-wrapper").find(".tf_slider-for").slick("slickNext");
          }),
          t(".reserve-button a").on("click", function () {
            t("html, body").animate({ scrollTop: t("#rooms").offset().top - 32 }, 1e3);
          }),
          t(document).on("click", "#featured-gallery", function (e) {
            e.preventDefault(), t("#tour-gallery").trigger("click");
          }),
          t(document).on("submit", "#tf_hotel_aval_check", function (a) {
            a.preventDefault();
            let o = t(this),
              n = o.find(".tf-submit"),
              i = new FormData(o[0]);
            i.append("action", "tf_hotel_search"),
              i.append("_nonce", tf_params.nonce),
              (null != i.get("from") && null != i.get("to")) || (i.append("from", tf_params.tf_hotel_min_price), i.append("to", tf_params.tf_hotel_max_price)),
              t.ajax({
                url: tf_params.ajax_url,
                type: "POST",
                data: i,
                contentType: !1,
                processData: !1,
                beforeSend: function () {
                  o.css({ opacity: "0.5", "pointer-events": "none" }), n.addClass("tf-btn-loading");
                },
                success: function (t) {
                  let a = JSON.parse(t);
                  o.css({ opacity: "1", "pointer-events": "all" }),
                    n.removeClass("tf-btn-loading"),
                    "error" === a.status && e.error(a.message),
                    "success" === a.status && (location.href = o.attr("action") + "?" + a.query_string);
                },
              });
          }),
          t("#tf-destination-adv").on("click", function (e) {
            t(this).val() ? t(".tf-hotel-locations").removeClass("tf-locations-show") : t(".tf-hotel-locations").addClass("tf-locations-show");
          }),
          t("#tf-destination-adv").on("keyup", function (e) {
            var a = t(this).val();
            t("#tf-place-destination").val(a);
          }),
          t("#tf-location").on("keyup", function (e) {
            var a = t(this).val();
            t("#tf-search-hotel").val(a);
          }),
          t(document).on("click", function (e) {
            t(e.target).closest("#tf-destination-adv").length || t(".tf-hotel-locations").removeClass("tf-locations-show");
          }),
          t("#ui-id-1 li").on("click", function (e) {
            var a = t(this).attr("data-name"),
              o = t(this).attr("data-slug");
            t(".tf-preview-destination").val(a), t("#tf-place-destination").val(o), t(".tf-hotel-locations").removeClass("tf-locations-show");
          });
        var i = document.getElementById("tf-location"),
          s = tf_params.locations;
        i &&
          (function (t, e) {
            var a;
            function o(t) {
              if (!t) return !1;
              !(function (t) {
                for (var e = 0; e < t.length; e++) t[e].classList.remove("autocomplete-active");
              })(t),
                a >= t.length && (a = 0),
                a < 0 && (a = t.length - 1),
                t[a].classList.add("autocomplete-active");
            }
            function n(e) {
              for (var a = document.getElementsByClassName("autocomplete-items"), o = 0; o < a.length; o++) e != a[o] && e != t && a[o].parentNode.removeChild(a[o]);
            }
            t.addEventListener("focus", function () {
              if ("" == this.value || !this.value) {
                let a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list"), a.classList.add("autocomplete-items"), this.parentNode.appendChild(a);
                for (const [o, n] of Object.entries(e)) {
                  let e = document.createElement("DIV");
                  (e.innerHTML = n),
                    (e.innerHTML += `<input type='hidden' value="${n}" data-slug='${o}'>`),
                    e.addEventListener("click", function (e) {
                      let a = this.getElementsByTagName("input")[0];
                      (t.value = a.value), (t.closest("input").nextElementSibling.value = a.dataset.slug);
                    }),
                    a.appendChild(e);
                }
              }
            }),
              t.addEventListener("keyup", function (o) {
                var i,
                  s,
                  r = this.value;
                n(), (a = -1), (i = document.createElement("DIV")).setAttribute("id", this.id + "autocomplete-list"), i.setAttribute("class", "autocomplete-items"), this.parentNode.appendChild(i);
                var l = [];
                for (const [a, o] of Object.entries(e))
                  o.substr(0, r.length).toUpperCase() == r.toUpperCase()
                    ? (l.push("found"),
                      ((s = document.createElement("DIV")).innerHTML = "<strong>" + o.substr(0, r.length) + "</strong>"),
                      (s.innerHTML += o.substr(r.length)),
                      (s.innerHTML += `<input type='hidden' value="${o}" data-slug='${a}'> `),
                      s.addEventListener("click", function (e) {
                        let a = this.getElementsByTagName("input")[0];
                        (t.value = a.value), (t.closest("input").nextElementSibling.value = a.dataset.slug), n();
                      }),
                      i.appendChild(s))
                    : l.push("notfound");
                -1 == l.indexOf("found") &&
                  (((s = document.createElement("DIV")).innerHTML += tf_params.no_found),
                  (s.innerHTML += "<input type='hidden' value=''>"),
                  s.addEventListener("click", function (e) {
                    (t.value = this.getElementsByTagName("input")[0].value), n();
                  }),
                  i.appendChild(s));
              }),
              t.addEventListener("keydown", function (t) {
                var e = document.getElementById(this.id + "autocomplete-list");
                e && (e = e.getElementsByTagName("div")), 40 == t.keyCode ? (a++, o(e)) : 38 == t.keyCode ? (a--, o(e)) : 13 == t.keyCode && (t.preventDefault(), a > -1 && e && e[a].trigger("click"));
              }),
              document.addEventListener("click", function (t) {
                ("content" != t.target.id && "" != t.target.id) || n(t.target);
              });
          })(i, s);
        const r = (a) => {
          var o = t("input[name=tf_room_booking_nonce]").val(),
            n = t("input[name=post_id]").val(),
            i = a.closest(".reserve").find("select[name=hotel_room_selected]").val(),
            s = a.closest(".tf-room").find("input[name=room_id]").val(),
            r = a.closest(".tf-room").find("input[name=unique_id]").val(),
            l = a.closest(".tf-room").find("input[name=make_deposit]").is(":checked");
          0 == i
            ? a
                .closest(".tf-room")
                .find(".roomselectissue")
                .html('<span style="color:red">' + tf_pro_params.select_room + "</span>")
            : (a.closest(".tf-room").find(".roomselectissue").html(""), t("#hotel_room_number").val(i), t("#hotel_roomid").val(s), t("#hotel_room_uniqueid").val(r), t("#hotel_room_depo").val(l));
          var c = t("input[name=place]").val(),
            f = t("input[name=adult]").val(),
            d = t("input[name=child]").val(),
            p = t("input[name=children_ages]").val(),
            u = t("input[name=check_in_date]").val(),
            m = t("input[name=check_out_date]").val();
          if (a.closest(".reserve").find("select[name=hotel_room_selected] option").filter(":selected").val())
            var h = a.closest(".reserve").find("select[name=hotel_room_selected] option").filter(":selected").val(),
              _ = a.closest(".tf-room").find("input[name=make_deposit]").is(":checked");
          else (h = t("#hotel_room_number").val()), (_ = t("#hotel_room_depo").val());
          var g = {
            action: "tf_hotel_booking_popup",
            tf_room_booking_nonce: o,
            post_id: n,
            room_id: s,
            unique_id: r,
            location: c,
            adult: f,
            child: d,
            children_ages: p,
            check_in_date: u,
            check_out_date: m,
            room: h,
            deposit: _,
            airport_service: a.closest('[name="airport_service"]:checked').val(),
          };
          t.ajax({
            type: "post",
            url: tf_params.ajax_url,
            data: g,
            beforeSend: function (e) {
              t("#tour_room_details_loader").show();
            },
            complete: function (t) {
              a.closest(".room-submit-wrap").siblings(".tf-withoutpayment-booking").find(".tf-hotel-booking-content").show(), a.unblock();
            },
            success: function (o) {
              a.unblock();
              var n = JSON.parse(o);
              if ("error" == n.status)
                return (
                  t("#tour_room_details_loader").hide(),
                  n.errors &&
                    n.errors.forEach(function (t) {
                      e.error(t);
                    }),
                  !1
                );
              t("#tour_room_details_loader").hide(),
                t(".tf-traveller-info-box").length > 0 && (t(".tf-traveller-info-box").html().trim(), t(".tf-traveller-info-box").html(n.guest_info)),
                t(".tf-booking-traveller-info").length > 0 && t(".tf-booking-traveller-info").html(n.hotel_booking_summery),
                a.closest("form.tf-room").find(".tf-withoutpayment-booking").hasClass("show") || a.closest("form.tf-room").find(".tf-withoutpayment-booking").addClass("show"),
                a.closest(".room-submit-wrap").siblings(".tf-withoutpayment-booking").find(".tf-control-pagination:first-child").show();
            },
            error: function (t) {
              console.log(t);
            },
          });
        };
        t(document).on("click", ".tf-hotel-booking-popup-btn", function (e) {
          e.preventDefault();
          var a = t(this);
          r(a);
        }),
          t(document).on("submit", "form.tf-room", function (e) {
            e.preventDefault();
            var a = t(this),
              o = new FormData(this),
              n = t("#hotel_room_depo").val(),
              i = t(this).find('[name="airport_service"]:checked').val();
            o.append("action", "tf_hotel_booking"),
              o.append("_ajax_nonce", tf_params.nonce),
              o.append("deposit", n),
              o.append("airport_service", i),
              t.ajax({
                type: "post",
                url: tf_params.ajax_url,
                data: o,
                processData: !1,
                contentType: !1,
                beforeSend: function (e) {
                  a.block({ message: null, overlayCSS: { background: "#fff", opacity: 0.5 } }), t("#tour_room_details_loader").show(), t(".tf-notice-wrapper").html("").hide();
                },
                error: function (t) {
                  console.log(t);
                },
                complete: function (e) {
                  a.unblock(), t("#tour_room_details_loader").hide(), t(".tf-withoutpayment-booking").removeClass("show"), a.find(".tf-withoutpayment-booking-confirm").addClass("show");
                },
              });
          }),
          t(document).on("change", "[name='airport_service']", function (e) {
            var a = t(this);
            r(a);
          }),
          t(".tf-hotel-facilities-title-area").on("click", function () {
            var e = t(this);
            e.hasClass("active") ||
              (t(".tf-hotel-facilities-content-area").slideUp(400), t(".tf-hotel-facilities-title-area").removeClass("active"), t(".hotel-facilities-icon-down").removeClass("active")),
              e.toggleClass("active"),
              t(this).closest(".tf-hotel-facilities-content-area").toggleClass("active"),
              t(this).find(".hotel-facilities-icon-down").toggle(),
              t(this).find(".hotel-facilities-icon-up").toggleClass("active"),
              e.next().slideToggle();
          });
      });
    })(jQuery, window),
    (function (t, e) {
      t(document).ready(function () {
        function e() {
          let t = tf_params.tour_form_data.flatpickr_locale;
          if (-1 !== jQuery.inArray(t, ["ar", "bn_BD", "de_DE", "es_ES", "fr_FR", "hi_IN", "it_IT", "nl_NL", "ru_RU", "zh_CN"]))
            switch (t) {
              case "bn_BD":
                t = "bn";
                break;
              case "de_DE":
                t = "de";
                break;
              case "es_ES":
                t = "es";
                break;
              case "fr_FR":
                t = "fr";
                break;
              case "hi_IN":
                t = "hi";
                break;
              case "it_IT":
                t = "it";
                break;
              case "nl_NL":
                t = "nl";
                break;
              case "ru_RU":
                t = "ru";
                break;
              case "zh_CN":
                t = "zh";
            }
          else t = "default";
          return t;
        }
        window.flatpickr.l10ns[e()].firstDayOfWeek = tf_params.tour_form_data.first_day_of_week;
        const a = new Notyf({ ripple: !0, duration: 3e3, dismissable: !0, position: { x: "right", y: "bottom" } });
        t(document).on("submit", "form.tf_tours_booking", function (e) {
          e.preventDefault();
          var o = t(this),
            n = new FormData(this);
          n.append("action", "tf_tours_booking"), n.append("_ajax_nonce", tf_params.nonce);
          var i = [],
            s = [];
          jQuery(".tour-extra-single").each(function (t) {
            let e = jQuery(this);
            if (e.find('input[name="tf-tour-extra"]').is(":checked")) {
              let t = e.find('input[name="tf-tour-extra"]').val();
              if ((i.push(t), e.find(".tf_quantity-acrselection").hasClass("quantity-active"))) {
                let t = e.find('input[name="extra-quantity"]').val();
                s.push(t);
              } else s.push(1);
            }
          }),
            n.append("tour_extra", i),
            n.append("tour_extra_quantity", s),
            t.ajax({
              type: "post",
              url: tf_params.ajax_url,
              data: n,
              processData: !1,
              contentType: !1,
              beforeSend: function (e) {
                o.block({ message: null, overlayCSS: { background: "#fff", opacity: 0.5 } }), t("#tour_room_details_loader").show(), t(".tf-notice-wrapper").html("").hide();
              },
              complete: function (t) {
                o.unblock();
              },
              success: function (e) {
                o.unblock();
                var n = JSON.parse(e);
                if ("false" == n.without_payment) {
                  if ("error" == n.status)
                    return (
                      t.fancybox.close(),
                      n.errors &&
                        n.errors.forEach(function (t) {
                          a.error(t);
                        }),
                      !1
                    );
                  n.redirect_to
                    ? window.location.replace(n.redirect_to)
                    : (jQuery(document.body).trigger("added_to_cart"), t("#tour_room_details_loader").hide(), t(".tf-withoutpayment-booking").removeClass("show"));
                } else t("#tour_room_details_loader").hide(), t(".tf-withoutpayment-booking").removeClass("show"), t(".tf-withoutpayment-booking-confirm").addClass("show");
              },
              error: function (t) {
                console.log(t);
              },
            });
        }),
          t('input[name="tf-tour-extra"]').on("change", function (e) {
            let a = t(this).parent().parent().parent();
            t(this).is(":checked") ? a.find(".tf_quantity-acrselection").addClass("quantity-active") : a.find(".tf_quantity-acrselection").removeClass("quantity-active");
          }),
          t('[data-fancybox="tour-gallery"]').fancybox({ loop: !0, buttons: ["zoom", "slideShow", "fullScreen", "close"], hash: !1 }),
          t(".tf-itinerary-gallery").fancybox({ buttons: ["zoom", "slideShow", "fullScreen", "close"] }),
          t(document).on("click", ".tf-single-tour-pricing .tf-price-tab li", function () {
            var e = t(this).attr("id");
            t(this).addClass("active").siblings().removeClass("active"), t(".tf-price").addClass("tf-d-n"), t("." + e + "-price").removeClass("tf-d-n");
          }),
          t(".tf-single-tour-pricing .tf-price-tab li:first-child").trigger("click"),
          t(document).on("click", ".tf-trip-person-info ul li", function () {
            var e = t(this).attr("data");
            t(this).addClass("active").siblings().removeClass("active"), t(".tf-trip-pricing").removeClass("active"), t(".tf-" + e).addClass("active");
          }),
          t(document).on("submit", "#tf_tour_aval_check", function (e) {
            e.preventDefault();
            let o = t(this),
              n = o.find(".tf-submit"),
              i = new FormData(o[0]);
            i.append("action", "tf_tour_search"),
              i.append("_nonce", tf_params.nonce),
              (null != i.get("from") && null != i.get("to")) || (i.append("from", tf_params.tf_tour_min_price), i.append("to", tf_params.tf_tour_max_price)),
              t.ajax({
                url: tf_params.ajax_url,
                type: "POST",
                data: i,
                contentType: !1,
                processData: !1,
                beforeSend: function () {
                  o.css({ opacity: "0.5", "pointer-events": "none" }), n.addClass("tf-btn-loading");
                },
                success: function (t) {
                  let e = JSON.parse(t);
                  o.css({ opacity: "1", "pointer-events": "all" }),
                    n.removeClass("tf-btn-loading"),
                    "error" === e.status && a.error(e.message),
                    "success" === e.status && (location.href = o.attr("action") + "?" + e.query_string);
                },
              });
          }),
          t(".tf-itinerary-title").on("click", function () {
            var e = t(this);
            e.hasClass("active") || (t(".tf-itinerary-content-box").slideUp(400), t(".tf-itinerary-title").removeClass("active"), t(".tf-single-itinerary-item").removeClass("active")),
              e.toggleClass("active"),
              t(this).closest(".tf-single-itinerary-item").toggleClass("active"),
              e.next().slideToggle();
          }),
          t(".tf-form-title.tf-tour-extra").on("click", function () {
            var e = t(this);
            e.hasClass("active") || (t(".tf-tour-extra-box").slideUp(400), t(".tf-form-title.tf-tour-extra").removeClass("active")), e.toggleClass("active"), e.next().slideToggle();
          }),
          t(".tf-accordion-head").on("click", function () {
            t(this).toggleClass("active"),
              t(this).parent().find(".arrow").toggleClass("arrow-animate"),
              t(this).parent().find(".tf-accordion-content").slideToggle(),
              t(this)
                .siblings()
                .find(".ininerary-other-gallery")
                .slick({
                  slidesToShow: 6,
                  slidesToScroll: 1,
                  arrows: !0,
                  fade: !1,
                  adaptiveHeight: !0,
                  infinite: !0,
                  useTransform: !0,
                  speed: 400,
                  cssEase: "cubic-bezier(0.77, 0, 0.18, 1)",
                  responsive: [
                    { breakpoint: 1024, settings: { slidesToShow: 4, slidesToScroll: 1 } },
                    { breakpoint: 640, settings: { slidesToShow: 2, slidesToScroll: 1 } },
                    { breakpoint: 420, settings: { slidesToShow: 2, slidesToScroll: 1 } },
                  ],
                });
          }),
          t("#tf-tour-location-adv").on("click", function (e) {
            t(this).val() ? t(".tf-tour-results").removeClass("tf-destination-show") : t(".tf-tour-results").addClass("tf-destination-show");
          }),
          t("#tf-tour-location-adv").on("keyup", function (e) {
            var a = t(this).val();
            t("#tf-tour-place").val(a);
          }),
          t("#tf-destination").on("keyup", function (e) {
            var a = t(this).val();
            t("#tf-search-tour").val(a);
          }),
          t(document).on("click", function (e) {
            t(e.target).closest("#tf-tour-location-adv").length || t(".tf-tour-results").removeClass("tf-destination-show");
          }),
          t("#ui-id-2 li").on("click", function (e) {
            var a = t(this).attr("data-name"),
              o = t(this).attr("data-slug");
            t(".tf-tour-preview-place").val(a), t("#tf-tour-place").val(o), t(".tf-tour-results").removeClass("tf-destination-show");
          });
        var o = document.getElementById("tf-destination"),
          n = tf_params.tour_destinations;
        o &&
          (function (t, e) {
            var a;
            function o(t) {
              if (!t) return !1;
              !(function (t) {
                for (var e = 0; e < t.length; e++) t[e].classList.remove("autocomplete-active");
              })(t),
                a >= t.length && (a = 0),
                a < 0 && (a = t.length - 1),
                t[a].classList.add("autocomplete-active");
            }
            function n(e) {
              for (var a = document.getElementsByClassName("autocomplete-items"), o = 0; o < a.length; o++) e != a[o] && e != t && a[o].parentNode.removeChild(a[o]);
            }
            t.addEventListener("focus", function () {
              if ("" == this.value || !this.value) {
                let a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list"), a.classList.add("autocomplete-items"), this.parentNode.appendChild(a);
                for (const [o, n] of Object.entries(e)) {
                  let e = document.createElement("DIV");
                  (e.innerHTML = n),
                    (e.innerHTML += `<input type='hidden' value="${n}" data-slug='${o}'>`),
                    e.addEventListener("click", function (e) {
                      let a = this.getElementsByTagName("input")[0];
                      (t.value = a.value), (t.closest("input").nextElementSibling.value = a.dataset.slug);
                    }),
                    a.appendChild(e);
                }
              }
            }),
              t.addEventListener("keyup", function (o) {
                var i,
                  s,
                  r = this.value;
                n(), (a = -1), (i = document.createElement("DIV")).setAttribute("id", this.id + "autocomplete-list"), i.setAttribute("class", "autocomplete-items"), this.parentNode.appendChild(i);
                var l = [];
                for (const [a, o] of Object.entries(e))
                  o.substr(0, r.length).toUpperCase() == r.toUpperCase()
                    ? (l.push("found"),
                      ((s = document.createElement("DIV")).innerHTML = "<strong>" + o.substr(0, r.length) + "</strong>"),
                      (s.innerHTML += o.substr(r.length)),
                      (s.innerHTML += `<input type='hidden' value="${o}" data-slug='${a}'> `),
                      s.addEventListener("click", function (e) {
                        let a = this.getElementsByTagName("input")[0];
                        (t.value = a.value), (t.closest("input").nextElementSibling.value = a.dataset.slug), n();
                      }),
                      i.appendChild(s))
                    : l.push("notfound");
                -1 == l.indexOf("found") &&
                  (((s = document.createElement("DIV")).innerHTML += tf_params.no_found),
                  (s.innerHTML += "<input type='hidden' value=''>"),
                  s.addEventListener("click", function (e) {
                    (t.value = this.getElementsByTagName("input")[0].value), n();
                  }),
                  i.appendChild(s));
              }),
              t.addEventListener("keydown", function (t) {
                var e = document.getElementById(this.id + "autocomplete-list");
                e && (e = e.getElementsByTagName("div")), 40 == t.keyCode ? (a++, o(e)) : 38 == t.keyCode ? (a--, o(e)) : 13 == t.keyCode && (t.preventDefault(), a > -1 && e && e[a].trigger("click"));
              }),
              document.addEventListener("click", function (t) {
                ("content" != t.target.id && "" != t.target.id) || n(t.target);
              });
          })(o, n),
          t(window).on("scroll", function () {
            var e = t(".tf-tour-booking-wrap");
            t(window).scrollTop() >= 800 ? e.addClass("tf-tours-fixed") : e.removeClass("tf-tours-fixed");
          }),
          t(".tf-tour-booking-box").length > 0 &&
            t(window).on("scroll", function () {
              let e = t(".tf-tour-booking-box"),
                a = t(".tf-bottom-booking-bar"),
                o = e.offset().top + e.outerHeight();
              t(window).scrollTop() > o ? a.addClass("active") : a.removeClass("active");
            }),
          t(document).on("click", ".tf-booking-mobile-btn", function (e) {
            e.preventDefault(), t(this).closest(".tf-bottom-booking-bar").toggleClass("mobile-active");
          }),
          t(".tf-template-3 .tf-mobile-booking-btn").on("click", function () {
            t(".tf-bottom-booking-bar").addClass("tf-mobile-booking-form"), t(".tf-template-3 .tf-mobile-booking-btn").slideUp(300);
          });
        const i = tf_params.tour_form_data.allowed_times ? JSON.parse(tf_params.tour_form_data.allowed_times) : [],
          s = tf_params.tour_form_data.custom_avail;
        function r(e) {
          let a = t('select[name="check-in-time"]'),
            o = t(".check-in-time-div");
          a.empty(),
            Object.keys(e).length > 0
              ? (a.append(`<option value="" selected hidden>${tf_params.tour_form_data.select_time_text}</option>`),
                t.each(e, function (t, e) {
                  a.append(`<option value="${t}">${e}</option>`);
                }),
                o.css("display", "flex"))
              : o.hide();
        }
        0 == s && Object.keys(i).length > 0 && r(i);
        var l = {
          enableTime: !1,
          dateFormat: "Y/m/d",
          altInput: !0,
          altFormat: tf_params.tour_form_data.date_format,
          locale: e(),
          onReady: function (t, e, a) {
            (a.element.value = e.replace(/[a-z]+/g, "-")), (a.altInput.value = a.altInput.value.replace(/[a-z]+/g, "-"));
          },
          onChange: function (e, a, o) {
            if (
              ((o.altInput.value = o.altInput.value.replace(/[a-z]+/g, "-")),
              t(".tours-check-in-out").val(o.altInput.value),
              t('.tours-check-in-out[type="hidden"]').val(a.replace(/[a-z]+/g, "-")),
              1 == s)
            ) {
              let t = Object.values(i).filter((t) => {
                let e = Date.parse(a),
                  o = Date.parse(t.date.from),
                  n = Date.parse(t.date.to);
                return o <= e && n >= e;
              });
              (t = t.length > 0 && t[0].times ? t[0].times : null), r(t);
            }
            "design-2" === tf_params.tour_form_data.tf_tour_selected_template &&
              (function (e, a) {
                if (1 === e.length) {
                  const a = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                  if (e[0]) {
                    const o = e[0];
                    t(".tf-template-3 .tf-bottom-booking-bar .tf-booking-form-checkinout span.tf-booking-date").html(o.getDate()),
                      t(".tf-template-3 .tf-bottom-booking-bar .tf-booking-form-checkinout span.tf-booking-month span").html(a[o.getMonth()]);
                  }
                }
                if (2 === e.length) {
                  const a = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                  if (e[0]) {
                    const o = e[0];
                    t(".tf-template-3 .tf-bottom-booking-bar .tf-booking-form-checkinout  span.tf-booking-date").html(o.getDate()),
                      t(".tf-template-3 .tf-bottom-booking-bar .tf-booking-form-checkinout span.tf-booking-month span").html(a[o.getMonth()]);
                  }
                  if (e[1]) {
                    const o = e[1];
                    t(".tf-template-3 .tf-bottom-booking-bar .tf-booking-form-checkinout  span.tf-booking-date").html(o.getDate()),
                      t(".tf-template-3 .tf-bottom-booking-bar .tf-booking-form-checkinout span.tf-booking-month span").html(a[o.getMonth()]);
                  }
                }
              })(e);
          },
        };
        if (
          ("fixed" == tf_params.tour_form_data.tour_type && ((l.defaultDate = tf_params.tour_form_data.defaultDate), (l.enable = tf_params.tour_form_data.enable)),
          "continuous" == tf_params.tour_form_data.tour_type &&
            ((l.minDate = "today"),
            (l.disableMobile = "true"),
            1 == s &&
              (l.enable = Object.values(tf_params.tour_form_data.cont_custom_date).map((t) => {
                let e = new Date(),
                  a = "",
                  o = e.getFullYear() + "/" + (e.getMonth() + 1) + "/" + e.getDate();
                if (tf_params.tour_form_data.disable_same_day)
                  if (t.date.from == o) {
                    let e = new Date(t.date.from),
                      o = new Date(e.setDate(e.getDate() + 1));
                    a = o.getFullYear() + "/" + (o.getMonth() + 1) + "/" + o.getDate();
                  } else a = t.date.from;
                else a = t.date.from;
                return { from: a, to: t.date.to };
              })),
            0 == s && (tf_params.tour_form_data.disabled_day || tf_params.tour_form_data.disable_range || tf_params.tour_form_data.disable_specific || tf_params.tour_form_data.disable_same_day)))
        ) {
          if (((l.disable = []), tf_params.tour_form_data.disabled_day)) {
            var c = tf_params.tour_form_data.disabled_day.map(Number);
            l.disable.push(function (t) {
              return 8 === t.getDay() || c.includes(t.getDay());
            });
          }
          tf_params.tour_form_data.disable_range &&
            Object.values(tf_params.tour_form_data.disable_range).forEach((t) => {
              l.disable.push({ from: t.date.from, to: t.date.to });
            }),
            tf_params.tour_form_data.disable_same_day && l.disable.push("today"),
            tf_params.tour_form_data.disable_specific &&
              tf_params.tour_form_data.disable_specific.split(", ").forEach(function (t) {
                l.disable.push(t);
              });
        }
        if (
          ("design-1" === tf_params.tour_form_data.tf_tour_selected_template &&
            (t(".tours-check-in-out").flatpickr(l),
            t("select[name='check-in-time']").on("change", function () {
              var e = t(this).val();
              t("select[name='check-in-time']").not(this).val(e);
            }),
            t(".acr-select input[type='number']").on("change", function () {
              var e = t(this).attr("name"),
                a = t(this).val();
              t(".acr-select input[type='number'][name='" + e + "']").val(a);
            })),
          "design-2" === tf_params.tour_form_data.tf_tour_selected_template)
        ) {
          if ((t(".tours-check-in-out").flatpickr(l), l.defaultDate)) {
            const e = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
              a = new Date(l.defaultDate);
            t(".tf-template-3 .tf-bottom-booking-bar .tf-booking-form-checkinout span.tf-booking-date").html(a.getDate()),
              t(".tf-template-3 .tf-bottom-booking-bar .tf-booking-form-checkinout span.tf-booking-month span").html(e[a.getMonth()]);
          }
          t("select[name='check-in-time']").on("change", function () {
            var e = t(this).val();
            t("select[name='check-in-time']").not(this).val(e);
          }),
            t(".acr-select input[type='tel']").on("change", function () {
              var e = t(this).attr("name"),
                a = t(this).val();
              t(".acr-select input[type='tel'][name='" + e + "']").val(a);
            });
        }
        "default" === tf_params.tour_form_data.tf_tour_selected_template && t("#check-in-out-date").flatpickr(l),
          t(document).on("click", "#tour-deposit > div > div.tf_button_group > button", function (e) {
            e.preventDefault();
            var a = t(document).find("form.tf_tours_booking");
            !0 === t(this).data("deposit") ? a.find('input[name="deposit"]').val(1) : a.find('input[name="deposit"]').val(0), a.submit();
          });
      });
    })(jQuery, window),
    (() => {
      function t(t, e) {
        var a, o, n;
        for (o = document.getElementsByClassName("tf-tabcontent"), a = 0; a < o.length; a++) o[a].style.display = "none";
        for (n = document.getElementsByClassName("tf-tablinks"), a = 0; a < n.length; a++) n[a].className = n[a].className.replace(" active", "");
        (document.getElementById(e).style.display = "block"), (document.getElementById(e).style.transition = "all 0.2s"), (t.target.className += " active");
      }
      !(function (e, a) {
        e(document).ready(function () {
          const o = new Notyf({ ripple: !0, duration: 3e3, dismissable: !0, position: { x: "right", y: "bottom" } });
          var n;
          e(".tf-top-review a").on("click", function () {
            e("html, body").animate({ scrollTop: e("#tf-review").offset().top - 32 }, 1e3);
          }),
            e(".tf-map-link a").on("click", function () {
              e("html, body").animate({ scrollTop: e("#tour-map").offset().top - 32 }, 1e3);
            });
          const i = (t = 1, a = []) => {
            var i = e("#tf-place").val(),
              s = e("#adults").val(),
              l = e("#room").val(),
              c = e("#children").val(),
              f = e("#infant").val(),
              d = e("#check-in-out-date").val(),
              p = e('.widget_tf_price_filters input[name="from"]').val(),
              u = e('.widget_tf_price_filters input[name="to"]').val(),
              m = e("#tf_author").val(),
              h = d ? d.split(" - ") : "",
              _ = h[0],
              g = h[1],
              v = e(".tf-post-type").val();
            let b = r("tf_filters"),
              k = r("tf_hotel_types"),
              w = r("tf_features"),
              y = r("tour_features"),
              C = r("tf_attractions"),
              x = r("tf_activities"),
              S = r("tf_tour_types"),
              T = r("tf_apartment_features"),
              D = r("tf_apartment_types"),
              q = e("#tf-orderby").find(":selected").val(),
              j = r("car_category"),
              E = r("car_fueltype"),
              I = r("car_engine_year"),
              L = e('.widget_tf_seat_filters input[name="from"]').val(),
              N = e('.widget_tf_seat_filters input[name="to"]').val(),
              M = e('input[name="same_location"]:checked').val(),
              $ = e('input[name="driver_age"]:checked').val(),
              B = e(".tf_pickup_date").val(),
              H = e(".tf_dropoff_date").val(),
              A = e(".tf_pickup_time").val(),
              V = e(".tf_dropoff_time").val(),
              F = e("#tf_pickup_location_id").val(),
              J = e("#tf_dropoff_location_id").val();
            var Q = new FormData();
            Q.append("action", "tf_trigger_filter"),
              Q.append("_nonce", tf_params.nonce),
              Q.append("type", v),
              Q.append("page", t),
              Q.append("dest", i),
              Q.append("adults", s),
              Q.append("room", l),
              Q.append("children", c || 0),
              Q.append("infant", f || 0),
              Q.append("checkin", _),
              Q.append("checkout", g),
              Q.append("filters", b),
              Q.append("features", w),
              Q.append("tf_hotel_types", k),
              Q.append("tour_features", y),
              Q.append("attractions", C),
              Q.append("activities", x),
              Q.append("tf_tour_types", S),
              Q.append("tf_apartment_features", T),
              Q.append("tf_apartment_types", D),
              Q.append("checked", d),
              Q.append("category", j),
              Q.append("fuel_type", E),
              Q.append("engine_year", I),
              Q.append("pickup", F),
              Q.append("dropoff", J),
              Q.append("pickup_date", B),
              Q.append("dropoff_date", H),
              Q.append("pickup_time", A),
              Q.append("dropoff_time", V),
              Q.append("same_location", M),
              Q.append("driver_age", $),
              Q.append("dropoff_time", V),
              Q.append("tf_ordering", q),
              Q.append("page", t),
              p && Q.append("startprice", p),
              u && Q.append("endprice", u),
              m && Q.append("tf_author", m),
              L && Q.append("min_seat", L),
              N && Q.append("max_seat", N),
              4 === a.length && (Q.append("mapCoordinates", a.join(",")), Q.append("mapFilter", !0)),
              n && 4 != n.readyState && n.abort(),
              (n = e.ajax({
                type: "post",
                url: tf_params.ajax_url,
                data: Q,
                processData: !1,
                contentType: !1,
                beforeSend: function (t) {
                  e(".archive_ajax_result").block({ message: null, overlayCSS: { background: "#fff", opacity: 0.5 } }),
                    e("#tf_ajax_searchresult_loader").show(),
                    "" !== e.trim(_) && e(".tf_booking-dates .tf_label-row").find("#tf-required").remove();
                },
                complete: function (t) {
                  if ((e(".archive_ajax_result").unblock(), e("#tf_ajax_searchresult_loader").hide(), e(".tf-nothing-found")[0])) {
                    e(".tf_posts_navigation").hide();
                    var a = e(".tf-nothing-found").data("post-count");
                    e(".tf-total-results").find("span").html(a);
                  } else {
                    e(".tf_posts_navigation").show();
                    var o = e(".tf-posts-count").html(),
                      n = e(".tf-map-posts-count").html();
                    e(".tf-total-results").find("span").html(o), e(".tf-total-results").find("span.tf-map-item-count").html(n);
                  }
                },
                success: function (t, n) {
                  if (
                    (e(".archive_ajax_result").unblock(),
                    e("#tf_ajax_searchresult_loader").hide(),
                    e(".archive_ajax_result").html(t),
                    e(".tf-filter-cars") && e(".tf-filter-cars").removeClass("tf-btn-loading"),
                    e(".tf-details-right").length > 0 && e(".tf-details-right").removeClass("tf-filter-show"),
                    e("#tf-hotel-archive-map").length)
                  ) {
                    var i = e("#map-datas").html();
                    e("#map-datas").length && i.length ? O(i) : O("");
                  }
                  a.length || o.success(tf_params.ajax_result_success);
                },
                error: function (t) {
                  console.log(t);
                },
              }));
          };
          function s(t) {
            return t.find("span").remove(), parseInt(t.html());
          }
          e(document).on("click", ".tf_search_ajax_pagination a.page-numbers", function (t) {
            t.preventDefault(), (page = s(e(this).clone())), i(page);
          }),
            e(document).on("click", "tf_tax_posts_navigation a.page-numbers", function (t) {
              t.preventDefault(), (page = s(e(this).clone())), i(page);
            }),
            e(document).on("submit", "#tf-widget-booking-search", function (t) {
              t.preventDefault(), i();
            }),
            e(document).on(
              "change",
              '.widget_tf_price_filters input[name="from"], .widget_tf_price_filters input[name="to"], [name*=tf_filters],[name*=tf_hotel_types],[name*=tf_features],[name*=tour_features],[name*=tf_attractions],[name*=tf_activities],[name*=tf_tour_types],[name*=tf_apartment_features],[name*=tf_apartment_types], [name*=car_category],[name*=car_fueltype],[name*=car_engine_year]',
              function () {
                e(".filter-reset-btn").length > 0 && e(".filter-reset-btn").show(), i();
              }
            ),
            e(document).on("submit", ".tf_archive_search_result", function (t) {
              t.preventDefault(), (checked = e("#check-in-out-date").val());
              var a = checked.split(" - "),
                o = a[0],
                n = (a[1], e(".tf-post-type").val());
              ("" === e.trim(o) && tf_params.date_hotel_search && "tf_hotel" === n) ||
              ("" === e.trim(o) && tf_params.date_tour_search && "tf_tours" === n) ||
              ("" === e.trim(o) && tf_params.date_apartment_search && "tf_apartment" === n)
                ? 0 === e("#tf-required").length &&
                  (1 === e(".tf_booking-dates .tf_label-row").length
                    ? e(".tf_booking-dates .tf_label-row").append('<span id="tf-required" class="required" style="color:white;"><b>' + tf_params.field_required + "</b></span>")
                    : e("#check-in-out-date").trigger("click"))
                : i();
            }),
            e(document).on("click", ".filter-reset-btn", function (t) {
              t.preventDefault(),
                e(
                  "[name*=tf_filters],[name*=tf_hotel_types],[name*=tf_features],[name*=tour_features],[name*=tf_attractions],[name*=tf_activities],[name*=tf_tour_types],[name*=tf_apartment_features],[name*=tf_apartment_types], [name*=car_category],[name*=car_fueltype],[name*=car_engine_year]"
                ).prop("checked", !1),
                i(),
                e(".filter-reset-btn").hide(),
                e(".tf-archive-filter-sidebar").length > 0 && e(".tf-archive-filter-sidebar").removeClass("tf-show");
            }),
            e(".tf-archive-ordering").on("change", "select.tf-orderby", function (t) {
              e(this).closest("form").trigger("submit");
            }),
            e(".tf-archive-ordering").on("submit", function (t) {
              t.preventDefault(), i();
            }),
            e(document).on("click", ".tf-filter-cars", function (t) {
              if ((e(this).addClass("tf-btn-loading"), tf_params.location_car_search))
                if ("on" == e('input[name="same_location"]:checked').val()) {
                  if ("" == e.trim(e("#tf_pickup_location").val()))
                    return (
                      0 === e("#tf-required").length &&
                        (1 === e(".tf-driver-location").length
                          ? e(".tf-driver-location").append('<span id="tf-required" class="required"><b>Select Pickup & Dropoff Location</b></span>')
                          : e("#tf_pickup_location").trigger("click")),
                      void e(".tf-filter-cars").removeClass("tf-btn-loading")
                    );
                  1 === e("#tf-required").length && e(".tf-driver-location .required").remove();
                } else {
                  if ("" == e.trim(e("#tf_pickup_location").val()) || "" == e.trim(e("#tf_dropoff_location").val()))
                    return (
                      0 === e("#tf-required").length &&
                        (1 === e(".tf-driver-location").length
                          ? e(".tf-driver-location").append('<span id="tf-required" class="required"><b>Select Pickup & Dropoff Location</b></span>')
                          : e("#tf_pickup_location").trigger("click")),
                      void e(".tf-filter-cars").removeClass("tf-btn-loading")
                    );
                  1 === e("#tf-required").length && e(".tf-driver-location .required").remove();
                }
              if (tf_params.date_car_search) {
                if ("" == e.trim(e(".tf_pickup_date").val()) || "" == e.trim(e(".tf_dropoff_date").val()))
                  return (
                    0 === e("#tf-required").length &&
                      (1 === e(".tf-driver-location").length
                        ? e(".tf-driver-location").append('<span id="tf-required" class="required"><b>Select Pickup & Dropoff Date</b></span>')
                        : e(".tf_pickup_date").trigger("click")),
                    void e(".tf-filter-cars").removeClass("tf-btn-loading")
                  );
                1 === e("#tf-required").length && e(".tf-driver-location .required").remove();
              }
              e(".filter-reset-btn").length > 0 && e(".filter-reset-btn").show(), i();
            }),
            e(document).on("click", '.tf-driver-location [name="same_location"]', function (t) {
              e(this).is(":checked") ? e(".tf-pick-drop-location").addClass("active") : e(".tf-pick-drop-location").removeClass("active");
            });
          const r = (t) => {
            let a = [];
            return (
              e(`[name*=${t}]`).each(function () {
                e(this).is(":checked") && a.push(e(this).val());
              }),
              a.join()
            );
          };
          (e.fn.inViewport = function (t) {
            return this.each(function (o, n) {
              function i() {
                var a = e(this).height(),
                  o = n.getBoundingClientRect(),
                  i = o.top,
                  s = o.bottom;
                return t.call(n, Math.max(0, i > 0 ? a - i : s < a ? s : a));
              }
              i(), e(a).on("resize scroll", i);
            });
          }),
            e(window).on("load", function () {
              jQuery("[data-width]").each(function () {
                var t = jQuery(this),
                  e = t.attr("data-width");
                t.inViewport(function (a) {
                  a > 0 ? t.css("width", +e + "%") : t.css("width", "0%");
                });
              });
            }),
            e('.share-toggle[data-toggle="true"]').on("click", function (t) {
              t.preventDefault();
              var a = e(this).attr("href");
              e(a).slideToggle("fast");
            }),
            e("button#share_link_button").on("click", function () {
              e(this).addClass("copied"),
                setTimeout(function () {
                  e("button#share_link_button").removeClass("copied");
                }, 3e3),
                e(this).parent().find("#share_link_input").select(),
                document.execCommand("copy");
            }),
            e(".tf-slider-items-wrapper,.tf-slider-activated").slick({
              dots: !0,
              arrows: !1,
              infinite: !0,
              speed: 300,
              autoplaySpeed: 2e3,
              slidesToShow: 3,
              slidesToScroll: 1,
              responsive: [
                { breakpoint: 1024, settings: { slidesToShow: 3, slidesToScroll: 1, infinite: !0, dots: !0 } },
                { breakpoint: 600, settings: { slidesToShow: 2, slidesToScroll: 1 } },
                { breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1 } },
              ],
            }),
            e(".tf-design-3-slider-items-wrapper").slick({
              dots: !1,
              arrows: !0,
              infinite: !0,
              speed: 300,
              autoplaySpeed: 2e3,
              slidesToShow: 3,
              slidesToScroll: 1,
              responsive: [
                { breakpoint: 1024, settings: { slidesToShow: 2, slidesToScroll: 1, infinite: !0, dots: !1 } },
                { breakpoint: 600, settings: { slidesToShow: 1, slidesToScroll: 1 } },
                { breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1 } },
              ],
            }),
            e(".tf-review-items-wrapper").slick({
              dots: !0,
              arrows: !1,
              infinite: !0,
              speed: 300,
              autoplay: !0,
              autoplaySpeed: 2e3,
              slidesToShow: 4,
              slidesToScroll: 1,
              responsive: [
                { breakpoint: 1024, settings: { slidesToShow: 4, slidesToScroll: 1, infinite: !0, dots: !0 } },
                { breakpoint: 600, settings: { slidesToShow: 3, slidesToScroll: 1 } },
                { breakpoint: 480, settings: { slidesToShow: 2, slidesToScroll: 1 } },
              ],
            });
          const l = "wishlist_item",
            c = () => {
              let t = localStorage.getItem(l);
              return null === t ? [] : JSON.parse(t);
            },
            f = () => {
              let t = e(".tf-wishlist-holder");
              e.each(t, function (t, a) {
                let o = e(a).data("type");
                o = o ? o.split(",") : void 0;
                let n = c();
                void 0 !== o && (n = n.filter((t) => o.includes(t.type)));
                let i = n.map((t) => t.post),
                  s = { nonce: e(a).data("nonce"), action: "tf_generate_table", ids: i };
                e.post(tf_params.ajax_url, s, function (t) {
                  t.success && e(a).html(t.data);
                });
              });
            },
            d = (t) => {
              t.addClass("remove-wishlist"), t.addClass("fa-heart"), t.addClass("tf-text-red"), t.removeClass("fa-heart-o"), t.removeClass("add-wishlist");
            },
            p = (t) => {
              t.addClass("add-wishlist"), t.addClass("fa-heart-o"), t.removeClass("fa-heart"), t.removeClass("tf-text-red"), t.removeClass("remove-wishlist");
            };
          var u;
          e(document).on("click", ".add-wishlist", function () {
            let t = e(".add-wishlist"),
              a = { type: t.data("type"), post: t.data("id") };
            return (
              t.data("page-title"),
              t.data("page-url"),
              e("body").hasClass("logged-in")
                ? ((a.action = "tf_add_to_wishlists"),
                  (a.nonce = t.data("nonce")),
                  e.ajax({
                    type: "post",
                    url: tf_params.ajax_url,
                    data: a,
                    beforeSend: function (t) {
                      o.success(tf_params.wishlist_add);
                    },
                    success: function (e) {
                      e.success && (d(t), o.success({ message: e.data, duration: 4e3 }));
                    },
                  }))
                : !0 ===
                  ((t) => {
                    let e = c();
                    return 0 === e.filter((e) => e.post == t.post).length && (e.push(t), localStorage.setItem(l, JSON.stringify(e)), !0);
                  })(a)
                ? (o.success(tf_params.wishlist_add), d(t), o.success({ message: tf_params.wishlist_added, duration: 4e3 }))
                : o.error(tf_params.wishlist_add_error),
              !1
            );
          }),
            e("body").find(".tf-wishlist-holder").length && f(),
            e(document).on("click", ".remove-wishlist", function () {
              let t = e(".remove-wishlist"),
                a = t.data("id");
              if (e("body").hasClass("logged-in")) {
                let n = t.closest("table"),
                  i = { id: a, action: "tf_remove_wishlist", type: n.data("type"), nonce: t.data("nonce") };
                e.get(tf_params.ajax_url, i, function (e) {
                  e.success && ("1" != tf_params.single && n.closest(".tf-wishlists").html(e.data), p(t), o.success(tf_params.wishlist_removed));
                });
              } else
                1 ==
                ((t) => {
                  let e = c(),
                    a = e.findIndex((e) => e.post == t);
                  return a >= 0 && (e.splice(a, 1), localStorage.setItem(l, JSON.stringify(e)), "1" != tf_params.single && f(), !0);
                })(a)
                  ? (p(t), o.success(tf_params.wishlist_removed))
                  : o.error(tf_params.wishlist_remove_error);
            }),
            (() => {
              if (!e(document).hasClass("logged-in") && e(document).find(".add-wishlist")) {
                let t = e(".add-wishlist"),
                  a = t.data("id");
                c().findIndex((t) => t.post == a) >= 0 ? d(t) : p(t);
              }
            })(),
            e(document).on("click", ".tf_selectperson-wrap .tf_input-inner,.tf_person-selection-wrap .tf_person-selection-inner", function () {
              e(".tf_acrselection-wrap").slideToggle("fast");
            }),
            jQuery(document).on("click", function (t) {
              jQuery(t.target).closest(".tf_selectperson-wrap").length || jQuery(".tf_acrselection-wrap").slideUp("fast");
            }),
            e(".acr-inc, .quanity-acr-inc").on("click", function (t) {
              var a = e(this).parent().find("input"),
                o = a.attr("max") ? a.attr("max") : 999,
                n = a.attr("step") ? a.attr("step") : 1;
              a.val() || a.val(0), a.val() < o && a.val(parseInt(a.val()) + parseInt(n)).change(), a.blur();
            }),
            e(".acr-dec, .quanity-acr-dec").on("click", function (t) {
              var a = e(this).parent().find("input"),
                o = a.attr("min") ? a.attr("min") : 0,
                n = a.attr("step") ? a.attr("step") : 1;
              a.val() || a.val(0), a.val() > o && a.val(a.val() - parseInt(n)).change();
            }),
            e(document).on("change", "#adults", function () {
              let t = e(this).val();
              t > 1
                ? e(".tf_selectperson-wrap")
                    .find(".adults-text")
                    .text(t + " " + tf_params.adult + "s")
                : e(".tf_selectperson-wrap")
                    .find(".adults-text")
                    .text(t + " " + tf_params.adult);
            }),
            e(document).on("change", "#children", function () {
              let t = e(this).val();
              e(".tf_selectperson-wrap")
                .find(".child-text")
                .text(t + " " + tf_params.children);
            }),
            e(document).on("change", "#infant", function () {
              let t = e(this).val();
              e(".tf_selectperson-wrap")
                .find(".infant-text")
                .text(t + " " + tf_params.infant);
            }),
            e(document).on("change", ".adults-style2", function () {
              let t = e(this),
                a = t.val(),
                o = e(this).closest(".tf_hotel-shortcode-design-2"),
                n = 0;
              n = t.parent().parent().siblings().find(".childs-style2").length > 0 ? parseInt(t.parent().parent().siblings().find(".childs-style2").val()) : parseInt(0);
              let i = 0;
              i = t.parent().parent().siblings().find(".infant-style2").length > 0 ? parseInt(t.parent().parent().siblings().find(".childs-style2").val()) : parseInt(0);
              let s = n + i + parseInt(a);
              s > 1 && o.find(".tf_guest_number .guest").text(s);
            }),
            e(document).on("change", ".childs-style2", function () {
              let t = e(this),
                a = t.val(),
                o = e(this).closest(".tf_hotel-shortcode-design-2"),
                n = 0;
              n = t.parent().parent().siblings().find(".adults-style2").length > 0 ? parseInt(t.parent().parent().siblings().find(".adults-style2").val()) : parseInt(0);
              let i = 0;
              i = t.parent().parent().siblings().find(".infant-style2").length > 0 ? parseInt(t.parent().parent().siblings().find(".infant-style2").val()) : parseInt(0);
              let s = n + i + parseInt(a);
              s > 1 && o.find(".tf_guest_number .guest").text(s);
            }),
            e(document).on("change", ".infant-style2", function () {
              let t = e(this),
                a = t.val(),
                o = e(this).closest(".tf_hotel-shortcode-design-2"),
                n = 0;
              n = t.parent().parent().siblings().find(".adults-style2").length > 0 ? parseInt(t.parent().parent().siblings().find(".adults-style2").val()) : parseInt(0);
              let i = 0;
              i = t.parent().parent().siblings().find(".childs-style2").length > 0 ? parseInt(t.parent().parent().siblings().find(".childs-style2").val()) : parseInt(0);
              let s = n + i + parseInt(a);
              s > 1 && o.find(".tf_guest_number .guest").text(s);
            }),
            e(document).on("change", "#room", function () {
              let t = e(this),
                a = t.val();
              t.closest(".tf_selectperson-wrap")
                .find(".room-text")
                .text(a + " " + tf_params.room);
            }),
            e(document).on("change", ".rooms-style2", function () {
              let t = e(this).val(),
                a = parseInt(t);
              a > 1 && e(".tf_hotel-shortcode-design-2 .tf_guest_number .room").text(a);
            }),
            e(document).on("click", "#reply-title", function () {
              var t = e(this);
              e("#commentform").slideToggle("fast", "swing", function () {
                t.parent().toggleClass("active");
              });
            }),
            e(document).on("click", "#tf-ask-question-trigger", function (t) {
              t.preventDefault(), e("#tf-ask-question").fadeIn().find(".response").html(""), e("#tf-ask-question").is(":hidden") || e("body").css({ overflow: "hidden", "padding-right": "17px" });
            }),
            e(document).on("click", "span.close-aq", function () {
              e("#tf-ask-question").fadeOut(), e("body").removeAttr("style");
            }),
            e(document).on("click", ".tf-aq-overlay", function () {
              e("#tf-ask-question").fadeOut(), e("body").removeAttr("style");
            }),
            e(document).on("submit", "form#ask-question", function (t) {
              t.preventDefault();
              var a = e(this),
                o = new FormData(this);
              o.append("action", "tf_ask_question"),
                e.ajax({
                  type: "post",
                  url: tf_params.ajax_url,
                  data: o,
                  processData: !1,
                  contentType: !1,
                  beforeSend: function (t) {
                    a.block({ message: null, overlayCSS: { background: "#fff", opacity: 0.5 } }), a.find(".response").html(tf_params.sending_ques);
                  },
                  complete: function (t) {
                    a.unblock();
                  },
                  success: function (t) {
                    a.unblock();
                    var e = JSON.parse(t);
                    "sent" == e.status ? (a.find(".response").html(e.msg), a.find('[type="reset"]').trigger("click")) : a.find(".response").html(e.msg);
                  },
                  error: function (t) {
                    console.log(t);
                  },
                });
            }),
            e(document).on("click", ".change-view", function (t) {
              t.preventDefault(),
                e(".change-view").removeClass("active"),
                e(this).addClass("active"),
                "grid-view" == e(this).data("id") ? e(".archive_ajax_result").addClass("tours-grid") : e(".archive_ajax_result").removeClass("tours-grid");
            }),
            e(document).on("click", ".tf-grid-list-layout", function (t) {
              t.preventDefault(),
                e(".tf-grid-list-layout").removeClass("active"),
                e(this).addClass("active"),
                "grid-view" == e(this).data("id")
                  ? (e(".tf-item-cards").addClass("tf-layout-grid"), e(".tf-item-cards").removeClass("tf-layout-list"))
                  : (e(".tf-item-cards").addClass("tf-layout-list"), e(".tf-item-cards").removeClass("tf-layout-grid"));
            }),
            e(document).on("click", ".tf_posts_page_navigation a.page-numbers", function (t) {
              t.preventDefault();
              var a,
                o = t.target.href ? t.target.href : e(this).context.href;
              (a = o),
                u && 4 != u.readyState && u.abort(),
                (u = e.ajax({
                  url: a,
                  contentType: !1,
                  processData: !1,
                  asynch: !0,
                  beforeSend: function () {
                    e(document).find(".tf_posts_navigation").addClass("loading"), e(document).find(".archive_ajax_result").addClass("loading");
                  },
                  success: function (t) {
                    e(".archive_ajax_result").html(e(".archive_ajax_result", t).html()),
                      e(".tf_posts_navigation").html(e(".tf_posts_navigation", t).html()),
                      e(document).find(".tf_posts_navigation").removeClass("loading"),
                      e(document).find(".archive_ajax_result").removeClass("loading");
                  },
                })),
                window.history.pushState({ url: "" + o }, "", o);
            }),
            e(".tf_selectdate-wrap.tf_more_info_selections .tf_input-inner").on("click", function () {
              e(".tf-more-info").toggleClass("show");
            }),
            e(document).on("click", function (t) {
              e(t.target).closest(".tf_selectdate-wrap.tf_more_info_selections .tf_input-inner, .tf-more-info").length || e(".tf-more-info").removeClass("show");
            }),
            e(".tf-faq-title").on("click", function () {
              var t = e(this);
              t.hasClass("active") || (e(".tf-faq-desc").slideUp(400), e(".tf-faq-title").removeClass("active"), e(".arrow").removeClass("arrow-animate")),
                t.toggleClass("active"),
                t.next().slideToggle(),
                e(".arrow", this).toggleClass("arrow-animate");
            }),
            e(".tf-faq-collaps").on("click", function () {
              var t = e(this);
              t.hasClass("active") || (e(".tf-faq-content").slideUp(400), e(".tf-faq-collaps").removeClass("active"), e(".tf-faq-single").removeClass("active")),
                t.toggleClass("active"),
                t.next().slideToggle(),
                e(this).closest(".tf-faq-single").toggleClass("active");
            }),
            e(window).on("load", function () {
              e(".tf-tablinks").length > 0 && e(".tf-tablinks").first().trigger("click").addClass("active");
            }),
            e(document).on("click", ".tf-tablinks", function (a) {
              let o = e(this).data("form-id");
              t(event, o);
            }),
            e(document).on("change", 'select[name="tf-booking-form-tab-select"]', function () {
              var a = e(this).val();
              t(event, a);
            }),
            e(document).on("keyup", ".tf-hotel-side-booking #tf-location, .tf-hotel-side-booking #tf-destination", function () {
              let t = e(this).val();
              e(this).next("input[name=place]").val(t);
            }),
            e(".child-age-limited")[0] &&
              (e(".acr-select .child-inc").on("click", function () {
                var t = e('div[id^="tf-age-field-0"]'),
                  a = e('div[id^="tf-age-field-"]:last');
                if (0 != a.length) var o = parseInt(a.prop("id").match(/\d+/g), 10) + 1;
                var n = a.clone().prop("id", "tf-age-field-" + o);
                n.find("label").html("Child age " + o), n.find("select").attr("name", "children_ages[]"), a.after(n), n.show(), t.hide();
              }),
              e(".acr-select .child-dec").on("click", function () {
                var t = e(".tf-children-age").length,
                  a = e('div[id^="tf-age-field-"]:last');
                1 != t && a.remove();
              }));
          var m = e(".tf-posts-count").html();
          e(".tf-total-results").find("span").html(m),
            e(".tf-widget-title").on("click", function () {
              e(this).find("i").toggleClass("collapsed"), e(this).siblings(".tf-filter").slideToggle("medium");
            }),
            e("a.see-more").on("click", function (t) {
              var a = e(this);
              t.preventDefault(),
                a
                  .parent(".tf-filter")
                  .find(".filter-item")
                  .filter(function (t) {
                    return t > 3;
                  })
                  .removeClass("hidden"),
                a.hide(),
                a.parent(".tf-filter").find(".see-less").show();
            }),
            e("a.see-less").on("click", function (t) {
              var a = e(this);
              t.preventDefault(),
                a
                  .parent(".tf-filter")
                  .find(".filter-item")
                  .filter(function (t) {
                    return t > 3;
                  })
                  .addClass("hidden"),
                a.hide(),
                a.parent(".tf-filter").find(".see-more").show();
            }),
            e(".tf-filter").each(function () {
              var t = e(this).find("ul").children().length;
              e(this).find(".see-more").hide(),
                t > 4 && e(this).find(".see-more").show(),
                e(this)
                  .find(".filter-item")
                  .filter(function (t) {
                    return t > 3;
                  })
                  .addClass("hidden");
            }),
            e(".tf-category-lists").each(function () {
              var t = e(this).find("ul").children().length;
              e(this).find(".see-more").hide(),
                t > 4 && e(this).find(".see-more").show(),
                e(this)
                  .find(".filter-item")
                  .filter(function (t) {
                    return t > 3;
                  })
                  .addClass("hidden");
            }),
            e(".tf-category-lists a.see-more").on("click", function (t) {
              var a = e(this);
              t.preventDefault(),
                a
                  .parent(".tf-category-lists")
                  .find(".filter-item")
                  .filter(function (t) {
                    return t > 3;
                  })
                  .removeClass("hidden"),
                a.hide(),
                a.parent(".tf-category-lists").find(".see-less").show();
            }),
            e(".tf-category-lists a.see-less").on("click", function (t) {
              var a = e(this);
              t.preventDefault(),
                a
                  .parent(".tf-category-lists")
                  .find(".filter-item")
                  .filter(function (t) {
                    return t > 3;
                  })
                  .addClass("hidden"),
                a.hide(),
                a.parent(".tf-category-lists").find(".see-more").show();
            }),
            e(".tf_widget input").on("click", function () {
              e(this).parent().parent().toggleClass("active");
            }),
            e("form.checkout").on("click", ".cart_item a.remove", function (t) {
              t.preventDefault();
              var a = e(this).attr("data-cart_item_key");
              e.ajax({
                type: "POST",
                url: tf_params.ajax_url,
                data: { action: "tf_checkout_cart_item_remove", _nonce: tf_params.nonce, cart_item_key: a },
                beforeSend: function () {
                  e("body").trigger("update_checkout");
                },
                success: function (t) {
                  e("body").trigger("update_checkout");
                },
                error: function (t) {},
              });
            });
          let h = {
            range: { min: parseInt(tf_params.tf_hotel_min_price), max: parseInt(tf_params.tf_hotel_max_price), step: 1 },
            initialSelectedValues: { from: parseInt(tf_params.tf_hotel_min_price), to: parseInt(tf_params.tf_hotel_max_price) },
            grid: !1,
            theme: "dark",
          };
          0 != tf_params.tf_hotel_min_price && 0 != tf_params.tf_hotel_max_price && e(".tf-hotel-filter-range").alRangeSlider(h);
          var _ = new window.URLSearchParams(window.location.search);
          let g = {
            range: { min: parseInt(tf_params.tf_hotel_min_price), max: parseInt(tf_params.tf_hotel_max_price), step: 1 },
            initialSelectedValues: { from: _.get("from") ? _.get("from") : parseInt(tf_params.tf_hotel_min_price), to: _.get("to") ? _.get("to") : parseInt(tf_params.tf_hotel_max_price) },
            grid: !1,
            theme: "dark",
            onFinish: function () {
              i();
            },
          };
          0 != tf_params.tf_hotel_min_price && 0 != tf_params.tf_hotel_max_price && e(".tf-hotel-result-price-range").alRangeSlider(g);
          let v = {
            range: { min: parseInt(tf_params.tf_tour_min_price), max: parseInt(tf_params.tf_tour_max_price), step: 1 },
            initialSelectedValues: { from: parseInt(tf_params.tf_tour_min_price), to: parseInt(tf_params.tf_tour_max_price) },
            grid: !1,
            theme: "dark",
          };
          0 != tf_params.tf_tour_min_price && 0 != tf_params.tf_tour_max_price && e(".tf-tour-filter-range").alRangeSlider(v);
          let b = {
            range: { min: parseInt(tf_params.tf_tour_min_price), max: parseInt(tf_params.tf_tour_max_price), step: 1 },
            initialSelectedValues: { from: _.get("from") ? _.get("from") : parseInt(tf_params.tf_tour_min_price), to: _.get("to") ? _.get("to") : parseInt(tf_params.tf_tour_max_price) },
            grid: !1,
            theme: "dark",
            onFinish: function () {
              i();
            },
          };
          0 != tf_params.tf_tour_min_price && 0 != tf_params.tf_tour_max_price && e(".tf-tour-result-price-range").alRangeSlider(b);
          let k = {
            range: { min: parseInt(tf_params.tf_apartment_min_price), max: parseInt(tf_params.tf_apartment_max_price), step: 1 },
            initialSelectedValues: { from: _.get("from") ? _.get("from") : parseInt(tf_params.tf_apartment_min_price), to: _.get("to") ? _.get("to") : parseInt(tf_params.tf_apartment_max_price) },
            grid: !1,
            theme: "dark",
            onFinish: function () {
              i();
            },
          };
          0 != tf_params.tf_apartment_min_price && 0 != tf_params.tf_apartment_max_price && e(".tf-apartment-result-price-range").alRangeSlider(k);
          let w = {
            range: { min: parseInt(tf_params.tf_car_min_price), max: parseInt(tf_params.tf_car_max_price), step: 1 },
            initialSelectedValues: { from: _.get("from") ? _.get("from") : parseInt(tf_params.tf_car_min_price), to: _.get("to") ? _.get("to") : parseInt(tf_params.tf_car_max_price) },
            grid: !1,
            theme: "dark",
            onFinish: function () {
              e(".tf-filter-reset-btn").length > 0 && e(".tf-filter-reset-btn").show(), i();
            },
          };
          0 != tf_params.tf_car_min_price && 0 != tf_params.tf_car_max_price && e(".tf-car-result-price-range").alRangeSlider(w);
          let y = {
            range: { min: parseInt(tf_params.tf_car_min_seat), max: parseInt(tf_params.tf_car_max_seat), step: 1 },
            initialSelectedValues: { from: _.get("from") ? _.get("from") : parseInt(tf_params.tf_car_min_seat), to: _.get("to") ? _.get("to") : parseInt(tf_params.tf_car_max_seat) },
            grid: !1,
            theme: "dark",
            onFinish: function () {
              e(".tf-filter-reset-btn").length > 0 && e(".tf-filter-reset-btn").show(), i();
            },
          };
          0 != tf_params.tf_car_min_seat && 0 != tf_params.tf_car_max_seat && e(".tf-car-result-seat-range").alRangeSlider(y);
          let C = !1;
          e(document).on("click", ".tf-traveller-error", function (t) {
            let a = [],
              o = e(this).closest(".tf-withoutpayment-booking");
            if (
              (e(".error-text").text(""),
              o.find(".tf-single-travel").each(function () {
                e(this)
                  .find("input, select")
                  .each(function () {
                    if (e(this).attr("data-required") && 1 == e(this).attr("data-required") && "" == e(this).val()) {
                      a.push(!0);
                      const t = e(this).siblings(".error-text");
                      t.text("This field is required."), "" !== t.text() ? t.addClass("error-visible") : t.removeClass("error-visible");
                    }
                  }),
                  e(this)
                    .find('input[type="radio"], input[type="checkbox"]')
                    .each(function () {
                      if (e(this).attr("data-required")) {
                        const t = e(this).attr("name");
                        if (!(e('input[name="' + t + '"]:checked').length > 0)) {
                          a.push(!0);
                          const t = e(this).parent().siblings(".error-text");
                          t.text("This field is required."), "" !== t.text() ? t.addClass("error-visible") : t.removeClass("error-visible");
                        }
                      }
                    });
              }),
              a.includes(!0))
            )
              return (C = !0), !1;
            C = !1;
          }),
            e(document).on("click", ".tf-book-confirm-error, .tf-hotel-book-confirm-error", function (t) {
              let a = [],
                o = e(this).closest(".tf-withoutpayment-booking");
              if (
                (e(".error-text").text(""),
                o.find(".tf-confirm-fields").each(function () {
                  e(this)
                    .find("input, select")
                    .each(function () {
                      if (e(this).attr("data-required") && 1 == e(this).attr("data-required") && "" == e(this).val()) {
                        a.push(!0);
                        const t = e(this).siblings(".error-text");
                        t.text("This field is required."), "" !== t.text() ? t.addClass("error-visible") : t.removeClass("error-visible");
                      }
                    }),
                    e(this)
                      .find('input[type="radio"], input[type="checkbox"]')
                      .each(function () {
                        if (e(this).attr("data-required")) {
                          const t = e(this).attr("name");
                          if (!(e('input[name="' + t + '"]:checked').length > 0)) {
                            a.push(!0);
                            const t = e(this).parent().siblings(".error-text");
                            t.text("This field is required."), "" !== t.text() ? t.addClass("error-visible") : t.removeClass("error-visible");
                          }
                        }
                      });
                }),
                a.includes(!0))
              )
                return (C = !0), !1;
            }),
            e(document).on("click", ".tf-tabs-control", function (t) {
              if ((t.preventDefault(), C)) return !1;
              let a = e(this).attr("data-step");
              if (a > 1) {
                for (let t = 1; t <= a; t++) e(".tf-booking-step-" + t).removeClass("active"), e(".tf-booking-step-" + t).addClass("done");
                e(".tf-booking-step-" + a).addClass("active"),
                  e(".tf-booking-content").hide(),
                  e(".tf-booking-content-" + a).fadeIn(300),
                  e(".tf-control-pagination").hide(),
                  e(".tf-pagination-content-" + a).fadeIn(300);
              }
            }),
            e(document).on("click", ".tf-step-back", function (t) {
              t.preventDefault();
              let a = e(this).attr("data-step");
              if (
                (1 == a &&
                  (e(".tf-booking-step").removeClass("active"),
                  e(".tf-booking-step").removeClass("done"),
                  e(".tf-booking-step-" + a).addClass("active"),
                  e(".tf-booking-content").hide(),
                  e(".tf-booking-content-" + a).fadeIn(300),
                  e(".tf-control-pagination").hide(),
                  e(".tf-pagination-content-" + a).fadeIn(300)),
                a > 1)
              ) {
                let t = parseInt(a) + 1;
                e(".tf-booking-step-" + t).removeClass("active"),
                  e(".tf-booking-step-" + a).addClass("active"),
                  e(".tf-booking-step-" + a).removeClass("done"),
                  e(".tf-booking-step-" + t).removeClass("done"),
                  e(".tf-booking-content").hide(),
                  e(".tf-booking-content-" + a).fadeIn(300),
                  e(".tf-control-pagination").hide(),
                  e(".tf-pagination-content-" + a).fadeIn(300);
              }
            });
          const x = () => {
            var t = e(this);
            let a = e("#check-in-out-date").val(),
              n = e("#adults").val(),
              i = e("#children").val(),
              s = e("#infant").val(),
              r = e("input[name=post_id]").val(),
              l = e("select[name=check-in-time] option").filter(":selected").val();
            var c = e("input[name=deposit]").is(":checked"),
              f = [],
              d = [];
            e(".tour-extra-single").each(function (t) {
              let a = e(this);
              if (a.find('input[name="tf-tour-extra"]').is(":checked")) {
                let t = a.find('input[name="tf-tour-extra"]').val();
                if ((f.push(t), a.find(".tf_quantity-acrselection").hasClass("quantity-active"))) {
                  let t = a.find('input[name="extra-quantity"]').val();
                  d.push(t);
                } else d.push(1);
              }
            }),
              (f = f.join());
            var p = d.join(),
              u = {
                action: "tf_tour_booking_popup",
                _nonce: tf_params.nonce,
                post_id: r,
                adults: n,
                children: i,
                infant: s,
                check_in_date: a,
                check_in_time: l,
                tour_extra: f,
                tour_extra_quantity: p,
                deposit: c,
              };
            e.ajax({
              type: "post",
              url: tf_params.ajax_url,
              data: u,
              beforeSend: function (t) {
                e("#tour_room_details_loader").show();
              },
              complete: function (e) {
                t.unblock();
              },
              success: function (a) {
                t.unblock();
                var n = JSON.parse(a);
                if ("error" == n.status)
                  return (
                    e("#tour_room_details_loader").hide(),
                    n.errors &&
                      n.errors.forEach(function (t) {
                        o.error(t);
                      }),
                    !1
                  );
                e("#tour_room_details_loader").hide(),
                  e(".tf-traveller-info-box").length > 0 && (e(".tf-traveller-info-box").html().trim(), e(".tf-traveller-info-box").html(n.traveller_info)),
                  e(".tf-booking-traveller-info").length > 0 && e(".tf-booking-traveller-info").html(n.traveller_summery),
                  e(".tf-withoutpayment-booking").addClass("show");
              },
              error: function (t) {
                console.log(t);
              },
            });
          };
          function S() {
            var t = e(".tf-hotel-template-4 .tf-archive-hotels, .tf-archive-details-wrap .tf-archive-hotels");
            t[0].scrollHeight > t.height() ? t.css("padding-right", "16px") : t.css("padding-right", "0px");
          }
          function T() {
            var t = e(".tf-hotel-template-4 #tf__booking_sidebar, #tf_map_popup_sidebar");
            t[0].scrollHeight > t.height() ? t.css("padding-right", "16px") : t.css("padding-right", "0px");
          }
          e(document).on("click", ".tf-booking-popup-btn", function (t) {
            t.preventDefault(),
              e(
                ".tf-withoutpayment-booking input[type='text'], .tf-withoutpayment-booking input[type='email'], .tf-withoutpayment-booking input[type='date'], .tf-withoutpayment-booking select, .tf-withoutpayment-booking textarea"
              ).val(""),
              e('.tf-booking-content-extra input[type="checkbox"]').each(function () {
                1 == e(this).prop("checked") && e(this).prop("checked", !1);
              }),
              x();
          }),
            e(document).on("change", '[name*=tf-tour-extra], input[name="extra-quantity"]', function () {
              x();
            }),
            e(document).on("change", "[name=deposit]", function () {
              x();
            }),
            e(document).on("click", ".tf-booking-times span", function (t) {
              e(".tf-withoutpayment-booking").removeClass("show"),
                e(".tf-withoutpayment-booking-confirm").removeClass("show"),
                e(".tf-booking-tab-menu ul li").removeClass("active"),
                e(".tf-booking-tab-menu ul li").removeClass("done"),
                e(".tf-booking-tab-menu ul li:first-child").addClass("active"),
                e(".tf-booking-content").hide(),
                e(".tf-booking-content:first").show(),
                e(".tf-control-pagination").hide(),
                e(".tf-control-pagination:first").show();
            }),
            e(document).on("click", ".tf-modal-btn", function () {
              var t = e(this).attr("data-target");
              e(t).addClass("tf-modal-show"), e("body").addClass("tf-modal-open");
            }),
            e(document).on("click", ".tf-modal-close", function () {
              e(".tf-modal").removeClass("tf-modal-show"), e("body").removeClass("tf-modal-open");
            }),
            e(document).on("click", function (t) {
              e(".tf-map-modal").length || e(t.target).closest(".tf-modal-content,.tf-modal-btn").length || (e("body").removeClass("tf-modal-open"), e(".tf-modal").removeClass("tf-modal-show"));
            }),
            e(document).on("click", ".tf-room-detail-qv", function (t) {
              t.preventDefault(), e("#tour_room_details_loader").show();
              var a = e(this).attr("data-hotel"),
                o = e(this).attr("data-uniqid"),
                n = { action: "tf_tour_details_qv", _nonce: tf_params.nonce, post_id: a, uniqid_id: o };
              e.ajax({
                type: "post",
                url: tf_params.ajax_url,
                data: n,
                success: function (t) {
                  e("#tour_room_details_qv").html(t), e("#tour_room_details_loader").hide(), e.fancybox.open({ src: "#tour_room_details_qv", type: "inline" });
                },
              });
            }),
            e(document).on("click", ".tf-room-detail-popup", function (t) {
              t.preventDefault(), e("#tour_room_details_loader").show();
              var a = e(this).attr("data-hotel"),
                o = e(this).attr("data-uniqid"),
                n = { action: "tf_tour_details_qv", _nonce: tf_params.nonce, post_id: a, uniqid_id: o };
              e.ajax({
                type: "post",
                url: tf_params.ajax_url,
                data: n,
                success: function (t) {
                  e(".tf-room-popup").html(t), e(".tf-room-popup").addClass("tf-show"), e("#tour_room_details_loader").hide();
                },
              });
            }),
            e(".tf-template-3 .tf-share-toggle, .tf-hotel-template-4 .tf-share-toggle").on("click", function (t) {
              t.preventDefault(), e(".tf-share-toggle").toggleClass("actives"), e(".tf-off-canvas-share").toggleClass("show");
            }),
            e(".tf-template-3 .add-wishlist, .tf-hotel-template-4 .add-wishlist").on("click", function (t) {
              t.preventDefault(), e(this).parents().find(".tf-wishlist-box").addClass("actives");
            }),
            e(".tf-template-3 .remove-wishlist, .tf-hotel-template-4 .remove-wishlist").on("click", function (t) {
              t.preventDefault(), e(this).parents().find(".tf-wishlist-box").removeClass("actives");
            }),
            e("a#share_link_button").on("click", function (t) {
              t.preventDefault(),
                e(this).addClass("copied"),
                setTimeout(function () {
                  e("a#share_link_button").removeClass("copied");
                }, 3e3),
                e(this).parent().find("#share_link_input").select(),
                document.execCommand("copy");
            }),
            e(".tf-template-3 .tf-reviews-slider").slick({
              infinite: !0,
              slidesToShow: 3,
              slidesToScroll: 3,
              prevArrow:
                '<button class="slide-arrow prev-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="49" height="24" viewBox="0 0 49 24" fill="none"><path d="M8.32843 11.0009H44.5V13.0009H8.32843L13.6924 18.3648L12.2782 19.779L4.5 12.0009L12.2782 4.22266L13.6924 5.63687L8.32843 11.0009Z" fill="#B58E53"/></svg></button>',
              nextArrow:
                '<button class="slide-arrow next-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="49" height="24" viewBox="0 0 49 24" fill="none"><path d="M40.6716 11.0009H4.5V13.0009H40.6716L35.3076 18.3648L36.7218 19.779L44.5 12.0009L36.7218 4.22266L35.3076 5.63687L40.6716 11.0009Z" fill="#B58E53"/></svg></button>',
              responsive: [{ breakpoint: 993, settings: { slidesToShow: 1, slidesToScroll: 1 } }],
            }),
            e(".tf-template-3 .tf-question").on("click", function () {
              e(this).hasClass("tf-active") ||
                (e(this).siblings().removeClass("tf-active"),
                e(this).siblings().find(".tf-question-desc").slideUp(),
                e(this).parents(".tf-questions-col").siblings().find(".tf-question").removeClass("tf-active"),
                e(this).parents(".tf-questions-col").siblings().find(".tf-question-desc").slideUp()),
                e(this).toggleClass("tf-active"),
                e(this).find(".tf-question-desc").slideToggle();
            }),
            e(".tf-template-3 .tf-hero-hotel.tf-popup-buttons").on("click", function (t) {
              t.preventDefault(),
                e("#tour_room_details_loader").show(),
                setTimeout(function () {
                  e("#tour_room_details_loader").hide(), e(".tf-hotel-popup").addClass("tf-show");
                }, 1e3);
            }),
            e(document).on("click", ".tf-template-3 .tf-popup-close", function () {
              e(".tf-popup-wrapper").removeClass("tf-show");
            }),
            e(document).on("click", function (t) {
              e(t.target).closest(".tf-popup-wrapper .tf-popup-inner").length || e(".tf-popup-wrapper").removeClass("tf-show");
            }),
            e(".tf-template-3 .tf-details-menu a").on("click", function () {
              e(this).addClass("tf-hashlink"), e(this).closest("li").siblings().find("a").removeClass("tf-hashlink");
            }),
            e(".tf-template-3 .tf-available-rooms-head .tf-filter, .tf-hotel-template-4 .tf-available-rooms-head .tf-filter").on("click", function () {
              e(".tf-room-filter").toggleClass("tf-filter-show");
            }),
            e(".tf-template-3 .tf-archive-filter-showing").on("click", function () {
              e(".tf-archive-right").toggleClass("tf-filter-show");
            }),
            e(".tf-template-3 .tf-modify-search-btn").on("click", function () {
              e(".tf-booking-form-wrapper").slideDown(300), e(".tf-template-3 .tf-modify-search-btn").slideUp(300);
            }),
            e(".tf-template-3 span.tf-see-description, .tf-hotel-template-4 span.tf-see-description, .tf-single-car-section span.tf-see-description").on("click", function () {
              e(".tf-short-description").slideUp(), e(".tf-full-description").slideDown();
            }),
            e(".tf-template-3 span.tf-see-less-description, .tf-hotel-template-4 span.tf-see-less-description, .tf-single-car-section span.tf-see-less-description").on("click", function () {
              e(".tf-full-description").slideUp(), e(".tf-short-description").slideDown();
            }),
            e(".tf-template-3 .acr-inc , .tf-template-3 .acr-dec").on("click", function () {
              if (e("input#infant").length)
                var t =
                  Number(e("input#adults").val() ? e("input#adults").val() : 0) +
                  Number(e("input#children").val() ? e("input#children").val() : 0) +
                  Number(e("input#infant").val() ? e("input#infant").val() : 0);
              else t = Number(e("input#adults").val() ? e("input#adults").val() : 0) + Number(e("input#children").val() ? e("input#children").val() : 0);
              t.toString().length < 2 && (t = "0" + t), e("span.tf-guest").html(t);
              var a = Number(e("input#room").val());
              a.toString().length < 2 && (a = "0" + a), e("span.tf-room").html(a);
            }),
            e(document).ready(function () {
              if (e("input#infant").length)
                var t =
                  Number(e("input#adults").val() ? e("input#adults").val() : 0) +
                  Number(e("input#children").val() ? e("input#children").val() : 0) +
                  Number(e("input#infant").val() ? e("input#infant").val() : 0);
              else {
                t = Number(e("input#adults").val() ? e("input#adults").val() : 0) + Number(e("input#children").val() ? e("input#children").val() : 0);
                var a = Number(e("input#adults").val() ? e("input#adults").val() : 0),
                  o = Number(e("input#children").val() ? e("input#children").val() : 0);
              }
              t.toString().length < 2 && (t = "0" + t), e("span.tf-guest").html(t), e("span.tf-adult").html(a), e("span.tf-children").html(o);
            }),
            e(document).on("mouseup", function (t) {
              var a = e(".tf-template-3 .tf_acrselection-wrap");
              a.is(t.target) || 0 !== a.has(t.target).length || e(".tf-template-3 .tf-booking-form-guest-and-room .tf_acrselection-wrap").removeClass("tf-show");
            }),
            e(".tf-template-3 .tf-booking-form-guest-and-room").on("click", function () {
              e(".tf-template-3 .tf-booking-form-guest-and-room .tf_acrselection-wrap").addClass("tf-show");
            }),
            e(".tf-template-3 .tf-review-open.button").on("click", function () {
              e(".tf-template-3 .tf-sitebar-widgets .tf-review-form-wrapper").toggleClass("tf-review-show");
            }),
            e(document).on("click", ".tf-hotel-room-popup", function (t) {
              t.preventDefault(), e("#tour_room_details_loader").show();
              var a = e(this).attr("data-id"),
                o = e(this).attr("data-type"),
                n = { action: "tf_hotel_archive_popup_qv", _nonce: tf_params.nonce, post_id: a, post_type: o };
              e.ajax({
                type: "post",
                url: tf_params.ajax_url,
                data: n,
                success: function (t) {
                  e(".tf-popup-body").html(t), e(".tf-hotel-popup").addClass("tf-show"), e("#tour_room_details_loader").hide();
                },
              });
            }),
            e(".tf-hotel-template-4 .acr-inc , .tf-hotel-template-4 .acr-dec").on("click", function () {
              if (e("input#infant").length) var t = Number(e("input#adults").val()) + Number(e("input#children").val()) + Number(e("input#infant").val());
              else {
                t = Number(e("input#adults").val()) + Number(e("input#children").val());
                var a = Number(e("input#adults").val()),
                  o = Number(e("input#children").val());
              }
              t.toString().length < 2 && (t = "0" + t), e("span.tf-guest").html(t), e("span.tf-adult").html(a), e("span.tf-children").html(o);
              var n = Number(e("input#room").val());
              n.toString().length < 2 && (n = "0" + n), e("span.tf-room").html(n);
            }),
            e(document).mouseup(function (t) {
              var a = e(".tf-hotel-template-4 .tf_acrselection-wrap");
              a.is(t.target) || 0 !== a.has(t.target).length || e(".tf-hotel-template-4 .tf-search-guest-and-room .tf_acrselection-wrap").removeClass("tf-show");
            }),
            e(".tf-hotel-template-4 .tf-search-guest-and-room").click(function () {
              e(".tf-hotel-template-4 .tf-search-guest-and-room .tf_acrselection-wrap").addClass("tf-show");
            }),
            e(document).on("click", ".tf-archive-view li.tf-archive-view-item", function (t) {
              t.preventDefault(), e(".tf-archive-view li.tf-archive-view-item").removeClass("active"), e(this).addClass("active");
              let a = e(this).data("id"),
                o = e(".tf-archive-hotels");
              "grid-view" === a ? (o.addClass("tf-layout-grid"), o.removeClass("tf-layout-list")) : (o.addClass("tf-layout-list"), o.removeClass("tf-layout-grid")), S();
            }),
            e(".tf-hotel-template-4 .tf-archive-hotels").length && (S(), e(window).on("resize", S)),
            e(".tf-hotel-template-4 #tf__booking_sidebar").length && (T(), e(window).on("resize", T)),
            e(document).on("click", ".tf-archive-filter-btn", function () {
              e(".tf-archive-filter-sidebar").toggleClass("tf-show");
            }),
            e(document).click(function (t) {
              e(t.target).closest(".tf-archive-filter-sidebar, .tf-archive-filter-btn").length || e(".tf-archive-filter-sidebar").removeClass("tf-show");
            }),
            e(document).on("click", ".tf-room-modal-btn", function (t) {
              t.preventDefault(), e("#tour_room_details_loader").show();
              var a = e(this).attr("data-hotel"),
                o = e(this).attr("data-uniqid"),
                n = { action: "tf_tour_details_qv", _nonce: tf_params.nonce, post_id: a, uniqid_id: o };
              e.ajax({
                type: "post",
                url: tf_params.ajax_url,
                data: n,
                success: function (t) {
                  e(".tf-room-modal .tf-modal-body").html(t), e(".tf-room-modal").addClass("tf-modal-show"), e("body").addClass("tf-modal-open"), e("#tour_room_details_loader").hide();
                },
              });
            }),
            e(".tf-section-toggle-icon").on("click", function () {
              var t = e(this),
                a = t.closest(".tf-template-section");
              t.hasClass("active") || (a.find(".tf-section-toggle").slideUp(500), t.removeClass("active"), a.find(".tf-toggle-icon-down").removeClass("active")),
                t.toggleClass("active"),
                a.find(".tf-section-toggle").slideToggle();
            }),
            e(window).on("load resize", function () {
              !(function (t) {
                const a = e(".tf-details-menu-item");
                let o = [];
                a.each(function (t) {
                  let a = e(this).attr("href"),
                    n = e(a).offset().top - 60;
                  o.push([]), (o[t].switch = e(this)), (o[t].tgtOff = n);
                }),
                  e(window).scroll(function () {
                    for (let t = 0; t < o.length; t++) {
                      let n = e(window).scrollTop(),
                        i = o[t],
                        s = i.switch;
                      n >= i.tgtOff ? (a.removeClass("active"), s.addClass("active")) : s.removeClass("active");
                    }
                  });
              })();
            });
          var D,
            q = 5,
            j = !1,
            E = new google.maps.LatLng(23.8697847, 90.4219536),
            I = {},
            L = [],
            N = !1;
          const O = (t, e = 23.8697847, a = 90.4219536) => {
            L.forEach((t) => t.setMap(null)), (L = []);
            var o = t ? JSON.parse(t) : [];
            D ||
              (D = new google.maps.Map(document.getElementById("tf-hotel-archive-map"), {
                zoom: q,
                minZoom: 3,
                maxZoom: 18,
                center: new google.maps.LatLng(e, a),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [{ elementType: "labels.text.fill", stylers: [{ color: "#44348F" }] }],
                fullscreenControl: !1,
              }));
            var n = new google.maps.InfoWindow({ maxWidth: 262, disableAutoPan: !0 }),
              i = new google.maps.LatLngBounds();
            o.map(function (t, e) {
              var a = new MarkerWithLabel({
                position: new google.maps.LatLng(t.lat, t.lng),
                map: D,
                icon: document.getElementById("map-marker").dataset.marker,
                labelContent: '<div class="tf_price_inner" data-post-id="' + t.id + '">' + window.atob(t.price) + "</div>",
                labelAnchor: new google.maps.Point(0, 0),
                labelClass: "tf_map_price",
              });
              (I[t.id] = a), L.push(a), i.extend(a.position);
              const o = new google.maps.OverlayView();
              (o.draw = function () {}),
                o.setMap(D),
                google.maps.event.addListener(a, "mouseover", function () {
                  n.setContent(window.atob(t.content));
                  const e = a.getPosition(),
                    i = o.getProjection().fromLatLngToDivPixel(e),
                    s = i.x <= -120,
                    r = i.x >= 120;
                  let l = 0.5,
                    c = 0;
                  s ? (l = 0.9) : r && (l = 0.1), i.y - 305 <= -265 && (c = 355), n.setOptions({ pixelOffset: new google.maps.Size(262 * (l - 0.5), c) }), n.open(D, a);
                }),
                google.maps.event.addListener(a, "mouseout", function () {
                  n.close();
                }),
                google.maps.event.addListener(a, "click", function () {
                  window.open(t?.url, "_blank");
                });
            }),
              google.maps.event.addListener(D, "dragend", function () {
                (q = D.getZoom()), (E = D.getCenter()), (N = !0), M(D);
              }),
              google.maps.event.addListener(D, "zoom_changed", function () {
                j || ((q = D.getZoom()), (E = D.getCenter()), (N = !0), M(D));
              });
            var s = google.maps.event.addListener(D, "idle", function () {
              (j = !0), N ? (D.setZoom(q), D.setCenter({ lat: E.lat(), lng: E.lng() }), google.maps.event.removeListener(s)) : (D.fitBounds(i), (E = i.getCenter()), D.setCenter(E)), (j = !1);
            });
          };
          function M(t) {
            var e = t.getBounds();
            if (e)
              var a = e.getSouthWest(),
                o = e.getNorthEast();
            i("", [a.lat(), a.lng(), o.lat(), o.lng()]);
          }
          var $ = e("#map-datas").html();
          e("#map-datas").length && $.length && O($),
            e(document).on("mouseover", ".tf-hotel-template-4 .tf-archive-hotel", function () {
              let t = e(this).data("id");
              e('.tf_map_price .tf_price_inner[data-post-id="' + t + '"]').addClass("active"), I[t] && I[t].setAnimation(google.maps.Animation.BOUNCE);
            }),
            e(document).on("mouseleave", ".tf-hotel-template-4 .tf-archive-hotel", function () {
              let t = e(this).data("id");
              e('.tf_map_price .tf_price_inner[data-post-id="' + t + '"]').removeClass("active"), I[t] && I[t].setAnimation(null);
            }),
            e(document).on("click", ".tf-hotel-template-4 .tf-mobile-map-btn", function (t) {
              t.preventDefault(), e(".tf-hotel-template-4 .tf-details-right").css("display", "block");
            }),
            e(document).on("click", ".tf-hotel-template-4 .tf-mobile-list-btn", function (t) {
              t.preventDefault(), e(".tf-hotel-template-4 .tf-details-right").css("display", "none");
            }),
            e(document).on("click", ".tf-map-modal-btn", function (t) {
              t.preventDefault(),
                e(".tf-archive-filter-sidebar").length > 0 && e(".tf-archive-filter-sidebar").removeClass("tf-show"),
                e.fancybox.open({
                  src: ".tf-archive-details-wrap",
                  type: "inline",
                  touch: !1,
                  afterClose: function () {
                    e(".tf_template_4_hotel_archive .tf-archive-details-wrap, .tf_template_4_tour_archive .tf-archive-details-wrap, .tf_template_4_apartment_archive .tf-archive-details-wrap").css(
                      "display",
                      "block"
                    );
                  },
                  afterShow: function (t, a) {
                    t.$refs.container.addClass("tf-archive-details-fancy"),
                      e(".tf-archive-details-wrap .tf-archive-hotels").length && (S(), e(window).on("resize", S)),
                      e("#tf_map_popup_sidebar").length && (T(), e(window).on("resize", T));
                  },
                });
            });
        });
      })(jQuery, window),
        jQuery(".tf-search__form__field__input").on("input", function () {
          !(function (t) {
            let e,
              a = t.val().trim().length;
            (e = jQuery(window).width() < 992 ? 100 + 20 * Math.max(a - 1, 0) : 132 + 40 * Math.max(a - 1, 0)), t.closest(".tf-search__form__field.tf-mx-width").css("max-width", e + "px");
          })(jQuery(this));
        }),
        jQuery(".acr-inc").on("click", function () {
          jQuery(".tf-search__form__field__input").trigger("input");
        }),
        jQuery(".acr-dec").on("click", function () {
          jQuery(".tf-search__form__field__input").trigger("input");
        });
    })();
})();
