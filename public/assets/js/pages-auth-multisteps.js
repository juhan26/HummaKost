"use strict";
$(function () {
    var e = $(".select2");
    e.length &&
        e.each(function () {
            var e = $(this);
            select2Focus(e),
                e.wrap('<div class="position-relative"></div>'),
                e.select2({
                    placeholder: "Pilih divisi anda",
                    dropdownParent: e.parent(),
                });
        });
}),
    document.addEventListener("DOMContentLoaded", function (e) {
        var n = document.querySelector("#multiStepsValidation");
        if (null !== n) {
            var a = n.querySelector("#multiStepsForm");
            const d = a.querySelector("#accountDetailsValidation");
            var s = a.querySelector("#personalInfoValidation"),
                o = [].slice.call(a.querySelectorAll(".btn-next")),
                a = [].slice.call(a.querySelectorAll(".btn-prev")),
                r = document.querySelector(".multi-steps-exp-date"),
                l = document.querySelector(".multi-steps-cvv"),
                m = document.querySelector(".multi-steps-mobile"),
                u = document.querySelector(".multi-steps-pincode"),
                c = document.querySelector(".multi-steps-card");
            r &&
                new Cleave(r, {
                    date: !0,
                    delimiter: "/",
                    datePattern: ["m", "y"],
                }),
                l && new Cleave(l, { numeral: !0, numeralPositiveOnly: !0 }),
                m && new Cleave(m, { phone: !0, phoneRegionCode: "US" }),
                u && new Cleave(u, { delimiter: "", numeral: !0 }),
                c &&
                    new Cleave(c, {
                        creditCard: !0,
                        onCreditCardTypeChanged: function (e) {
                            document.querySelector(".card-type").innerHTML =
                                "" != e && "unknown" != e
                                    ? '<img src="' +
                                      assetsPath +
                                      "img/icons/payments/" +
                                      e +
                                      '-cc.png" height="18"/>'
                                    : "";
                        },
                    });
            let t = new Stepper(n, { linear: !0 });
            const p = FormValidation.formValidation(d, {
                    fields: {
                        email: {
                            validators: {
                                notEmpty: {
                                    message: "Tolong masukkan email anda",
                                },
                                emailAddress: {
                                    message:
                                        "Email yang anda masukkan tidak valid",
                                },
                            },
                        },
                        password: {
                            validators: {
                                notEmpty: { message: "Tolong masukkan password anda" },
                            },
                        },
                        password_confirmation: {
                            validators: {
                                notEmpty: {
                                    message: "Konfirmasi password diperlukan",
                                },
                                identical: {
                                    compare: function () {
                                        return d.querySelector(
                                            '[name="password"]'
                                        ).value;
                                    },
                                    message:
                                        "Field password dan konfirmasi password tidak sama",
                                },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap5: new FormValidation.plugins.Bootstrap5({
                            eleValidClass: "",
                            rowSelector: ".col-sm-6",
                        }),
                        autoFocus: new FormValidation.plugins.AutoFocus(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                    },
                    init: (e) => {
                        e.on("plugins.message.placed", function (e) {
                            e.element.parentElement.classList.contains(
                                "input-group"
                            ) &&
                                e.element.parentElement.insertAdjacentElement(
                                    "afterend",
                                    e.messageElement
                                );
                        });
                    },
                }).on("core.form.valid", function () {
                    t.next();
                }),
                v = FormValidation.formValidation(s, {
                    fields: {
                        name: {
                            validators: {
                                notEmpty: {
                                    message: "Tolong masukkan nama lengkap anda",
                                },
                            },
                        },
                        phone_number: {
                            validators: {
                                notEmpty: {
                                    message: "Tolong masukkan nomor telepon anda",
                                },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap5: new FormValidation.plugins.Bootstrap5({
                            eleValidClass: "",
                            rowSelector: function (e, t) {
                                switch (e) {
                                    case "name":
                                        return ".col-sm-6";
                                    case "multiStepsAddress":
                                        return ".col-md-12";
                                    default:
                                        return ".row";
                                }
                            },
                        }),
                        autoFocus: new FormValidation.plugins.AutoFocus(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                    },
                }).on("core.form.valid", function () {
                });

            o.forEach((e) => {
                e.addEventListener("click", (e) => {
                    switch (t._currentIndex) {
                        case 0:
                            p.validate();
                            break;
                        case 1:
                            v.validate();
                    }
                });
            }),
                a.forEach((e) => {
                    e.addEventListener("click", (e) => {
                        switch (t._currentIndex) {
                            case 1:
                                t.previous();
                        }
                    });
                });
        }
    });
