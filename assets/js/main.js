(function($) {
	"use strict";

	// -------------------------------------------------------------------------------------------------
	// NAVBAR SEARCH ................ Navbar search
	// SIDEBAR NAV .................. Sidebar nav
	// -------------------------------------------------------------------------------------------------

	$(document).ready(function() {
		initSidebarScrollbar();
		navbarSearch();
		sidebarNav();
		select2();
		flatpickr();
		tooltips();
		sidebarCollapse();
	});

	// -------------------------------------------------------------------------------------------------
	// NAVBAR SEARCH
	// -------------------------------------------------------------------------------------------------

	function navbarSearch() {
		$(".navbar-search__input").click(function(e) {
			e.preventDefault();
			var el = $(this);
			el.parent().addClass("focus");
		});
		$(document).click(function(e) {
			var el = $(".form-control");
			if (!el.is(e.target) && el.parent().has(e.target).length === 0) {
				el.parent().removeClass("focus");
			}
		});
	}

	// -------------------------------------------------------------------------------------------------
	// SIDEBAR
	// -------------------------------------------------------------------------------------------------

	function sidebarNav() {
		$(".sidebar-nav__link").on("click", function(event) {
			var el = $(this);
			var navItem = el.closest(".sidebar-nav__item");
			var isActive = el.parent().hasClass("is-active");

			$(".sidebar-nav__item").removeClass("is-active");

			if (!isActive) {
				el.parent().addClass("is-active");
			}

			if (
				$("body").hasClass("sidebar-sm") ||
				$("body").hasClass("sidebar-md")
			) {
				var offsetTop = 0;

				offsetTop = $(".sidebar").position().top + navItem.position().top + 65;
				$(".sidebar-subnav")
					.not(el.next())
					.slideUp(0);
				el.next().slideToggle(0);
				el.next().css("top", offsetTop);
			} else {
				$(".sidebar-subnav")
					.not(el.next())
					.slideUp(150);
				el.next().slideToggle(150);
			}

			//localStorage.setItem('navItem', elIndex);

			setTimeout(function() {
				$(document).trigger("recalculate-sidebar-scroll");
			}, 200);

			if (el.closest(".sidebar-nav__item").find(".sidebar-subnav").length) {
				return false;
			}
		});
	}

	$(".sidebar-section-nav__link").on("click", function(event) {
		var el = $(this);
		var navItem = el.closest(".sidebar-section-nav__item");
		var isActive = el.parent().hasClass("is-active");

		$(".sidebar-section-nav__item").removeClass("is-active");

		if (!isActive) {
			el.parent().addClass("is-active");
		}

		if ($("body").hasClass("sidebar-sm") || $("body").hasClass("sidebar-md")) {
			var offsetTop = 0;
			offsetTop = $(".sidebar-section").position().top + navItem.position().top;
			$(".sidebar-section-subnav")
				.not(el.next())
				.slideUp(0);
			el.next().slideToggle(0);
			el.next().css("top", offsetTop);
		} else {
			$(".sidebar-section-subnav")
				.not(el.next())
				.slideUp(150);
			el.next().slideToggle(150);
		}

		setTimeout(function() {
			$(document).trigger("recalculate-sidebar-scroll");
		}, 200);

		if (
			el.closest(".sidebar-section-nav__item").find(".sidebar-section-subnav")
				.length
		) {
			return false;
		}
	});

	function select2() {
		$("select")
			.not(".selectbox")
			.each(function() {
				var options = {
					placeholder: function() {
						var el = $(this);
						el.data("placeholder");
					}
				};

				if (!$(this).is("[data-search-enable]")) {
					options["minimumResultsForSearch"] = Infinity;
				}

				$(this).select2(options);
			});

		function formatUsers(user) {
			if (!user.id) {
				return user.text;
			}
			var $user = $(
				'<span class="select-user__img"><img src="img/users/' +
					user.element.value.toLowerCase() +
					'.png" /></span><span class="select-user__name">' +
					user.text +
					"</span>"
			);
			return $user;
		}

		$(".select-user").select2({
			dropdownCssClass: "select-user-dropdown",
			templateSelection: formatUsers,
			templateResult: formatUsers,
			minimumResultsForSearch: Infinity
		});

		$(".select2").click(function(e) {
			var el = $(this);
			el.find("b").hide();
		});
	}

	function flatpickr() {
		if (jQuery.flatpickr) {
			$(".flatpickr").flatpickr({
				altInput: true
			});
		}
	}

	function tooltips() {
		//$('[data-toggle="tooltip"]').tooltip();
		tippy('[data-toggle="tooltip"]', {
			arrow: true
		});
	}

	function toggleSidebar() {
		$("body").toggleClass("sidebar-sm");

		if ($("body").hasClass("sidebar-sm")) {
			initSidebarScrollbar(false);
		} else {
			initSidebarScrollbar(true);
		}

		var navItem = $(".sidebar-section-nav__item.is-active");

		if (navItem.length) {
			var el = navItem.find("> .sidebar-section-nav__link");
			var offsetTop =
				$(".sidebar-section").position().top +
				$(".sidebar-section-nav__item.is-active").position().top;
			el.next().css("top", offsetTop);
		}

		setTimeout(function() {
			$(document).trigger("recalculate-sidebar-scroll");
		}, 200);
	}

	function sidebarCollapse() {
		$(".sidebar__collapse").on("click", function() {
			toggleSidebar();
		});
	}

	$(document).on("collapse-sidebar", function() {
		toggleSidebar();
	});

	/**
	 * Scroll for any element
	 */
	$(".js-scrollable").each(function() {
		new SimpleBar(this);
	});

	function initSidebarScrollbar() {
		var autoHide = true;

		if ($("body").hasClass("sidebar-sm") || $("body").hasClass("sidebar-md")) {
			autoHide = false;
		}

		if ($(".sidebar").length) {
			if ($(".sidebar").hasClass("js-disable-scrollbar")) {
				return;
			}

			/**
			 * Scroll for sidebar
			 */
			if ($(".sidebar").css("position") === "fixed") {
				var sidebarScroll = new SimpleBar($(".sidebar__scroll").get(0), {
					autoHide: autoHide
				});

				sidebarScroll.getScrollElement().addEventListener("scroll", function() {
					if (
						$("body").hasClass("sidebar-sm") ||
						$("body").hasClass("sidebar-md")
					) {
						$(".sidebar-subnav").hide();
						$(".sidebar-nav__item").removeClass("is-active");
					}
				});
			}
		}

		if ($(".sidebar-section").length) {
			/**
			 * Scroll for section sidebar
			 */
			if ($(".sidebar-section").css("position") === "fixed") {
				var sidebarSectionScroll = new SimpleBar(
					$(".sidebar-section__scroll").get(0),
					{
						autoHide: autoHide
					}
				);

				sidebarSectionScroll
					.getScrollElement()
					.addEventListener("scroll", function() {
						if ($("body").hasClass("sidebar-sm")) {
							$(".sidebar-section-subnav").hide();
							$(".sidebar-section-nav__item").removeClass("is-active");
						}
					});
			}
		}
	}

	function sidebarActiveLink(sidebarName) {
		// Select current sidebar menu link
		var pathName = location.pathname.split("/");
		var url = pathName[pathName.length - 1];
		var currentSubNavLink = $(
			"." + sidebarName + '-subnav__link[href="' + url + '"]'
		);
		var currentNavLink = $(
			"." + sidebarName + '-nav__link[href="' + url + '"]'
		);

		if (currentSubNavLink.length) {
			currentSubNavLink.addClass("is-active");
			currentSubNavLink
				.closest("." + sidebarName + "-nav__item")
				.addClass("is-active");

			if (
				!$("body").hasClass("sidebar-sm") &&
				!$("body").hasClass("sidebar-md")
			) {
				currentSubNavLink.closest("." + sidebarName + "-subnav").show();
			}
		} else if (currentNavLink.length) {
			currentNavLink
				.closest("." + sidebarName + "-nav__item")
				.addClass("is-active");
		}
	}

	$(".textavatar").each(function() {
		$(this).textAvatar({
			width: $(this).data("width"),
			height: $(this).data("height")
		});
	});

	$(".sidebar-toggler").on("click", function() {
		$("body").toggleClass("sidebar-is-opened");
	});

	$(document).on("click", function(e) {
		if (
			$("body").hasClass("sidebar-is-opened") &&
			!$(e.target).closest(".sidebar-toggler").length
		) {
			if (!$(e.target).closest(".sidebar").length) {
				$("body").removeClass("sidebar-is-opened");
			}
		}

		if (
			$(".navbar-collapse").hasClass("show") &&
			!$(e.target).closest(".navbar-toggler").length
		) {
			if (!$(e.target).closest(".navbar-collapse").length) {
				$(".navbar-collapse").removeClass("show");
				$("body").removeClass("is-navbar-opened");
			}
		}

		// Hide sidebar submenu if sidebar collapsed
		if ($("body").hasClass("sidebar-sm") || $("body").hasClass("sidebar-md")) {
			var isSidebarToggleCheckbox = $(e.target)
				.closest(".switch")
				.find("#collapse-sidebar").length;

			if (!$(e.target).closest(".sidebar").length && !isSidebarToggleCheckbox) {
				$(".sidebar-subnav").hide();
				$(".sidebar-nav__item").removeClass("is-active");
			}

			if (
				!$(e.target).closest(".sidebar-section").length &&
				!isSidebarToggleCheckbox
			) {
				$(".sidebar-section-subnav").hide();
				$(".sidebar-section-nav__item").removeClass("is-active");
			}
		}
	});

	$(".navbar-toggler").on("click", function() {
		$("body").toggleClass("is-navbar-opened");
	});

	if ($(".js-page-preloader").length) {
		setTimeout(function() {
			$("#page-loader-progress-bar").css("width", "20%");
		}, 200);

		setTimeout(function() {
			$("#page-loader-progress-bar").css("width", "40%");
		}, 400);

		setTimeout(function() {
			$("#page-loader-progress-bar").css("width", "60%");
		}, 600);

		setTimeout(function() {
			$("#page-loader-progress-bar").css("width", "100%");
		}, 800);

		setTimeout(function() {
			$(".js-page-preloader").fadeOut(0);
			$("body").removeClass("js-loading");
		}, 1000);
	}

	$(".color-checkbox :checkbox").on("change", function() {
		var parent = $(this).closest(".color-checkbox");

		if (this.checked) {
			parent.addClass("is-checked");
		} else {
			parent.removeClass("is-checked");
		}
	});

	$(".color-radio :radio").on("click", function() {
		var parent = $(this).closest(".color-radio");
		var name = $(this).attr("name");

		$('.color-radio input[name="' + name + '"]').each(function() {
			$(this)
				.closest(".color-radio")
				.removeClass("is-checked");
		});

		parent.addClass("is-checked");
	});

	$(".btn").on("mouseup", function() {
		var self = this;

		setTimeout(function() {
			self.blur();
		}, 500);
	});

	if (jQuery.flatpickr) {
		$(".js-datepicker").flatpickr();
	}

	$('[data-toggle="popover"]').popover();

	sidebarActiveLink("sidebar");
	sidebarActiveLink("sidebar-section");

	$("[data-js-height]").each(function() {
		$(this).height($(this).data("js-height"));
	});

	$(".navbar .dropdown-toggle").on("click", function() {
		if ($("body").hasClass("sidebar-is-opened")) {
			$("body").removeClass("sidebar-is-opened");
		}
	});

	// crop ketika ganti foto profil(DIPERTIMBANGKAN)
	// event ketika upload foto profile
	// let upload_gambar = $("#upload_gambar");
	// var namaFile, uploadCrop, imageId;
	// uploadCrop = $(upload_gambar).croppie({
	// 	enableExif: true,
	// 	viewport: {
	// 		width: 200,
	// 		height: 200,
	// 		type: "circle"
	// 	},
	// 	boundary: {
	// 		width: 300,
	// 		height: 300
	// 	}
	// });
	// $(inputFile).on("change", function(e) {
	// 	namaFile = $(this)
	// 		.val()
	// 		.split("\\")
	// 		.pop();
	// 	imageId = $(this).data("id");
	// 	$("#cancelCropBtn").data("id", imageId);
	// 	$(".modal")
	// 		.modal("show")
	// 		.addClass("fade-in");
	// 	var reader = new FileReader();
	// 	reader.onload = function(e) {
	// 		uploadCrop
	// 			.croppie("bind", {
	// 				url: e.target.result
	// 			})
	// 			.then(function() {
	// 				console.log("jQuery bind complete");
	// 				// $(textUpload)
	// 				// 	.addClass("selected")
	// 				// 	.html(namaFile);
	// 			});
	// 	};
	// 	reader.readAsDataURL(this.files[0]);
	// });
	// $("#cropImageBtn").on("click", function(e) {
	// 	uploadCrop
	// 		.croppie("result", {
	// 			type: "canvas",
	// 			size: "viewport"
	// 			// size: { width: 70, height: 70 }
	// 		})
	// 		.then(function(resp) {
	// 			$("#image-data").val(resp);
	// 			$("#item-img-output").attr("src", resp);
	// 			$("#cropImagePop").modal("hide");
	// 			$(textUpload)
	// 				.addClass("selected")
	// 				.html(namaFile);
	// 			// $.ajax({
	// 			// 	url: window.location.href,
	// 			// 	type: "POST",
	// 			// 	data: { gambar: resp },
	// 			// 	success: function(data) {
	// 			// 		// html = '<img src="' + resp + '" />';
	// 			// 		// $("#upload-demo-i").html(html);
	// 			// 		document.location.href = window.location.href;
	// 			// 	}
	// 			// });
	// 		});
	// });

	// Event ketika upload gambar
	const inputFile = $(".btn-upload__input-file")[0];
	const textUpload = $(".btn-upload__file")[1];
	$(inputFile).on("change", function(e) {
		let fileName = $(this)
			.val()
			.split("\\")
			.pop();
		$(textUpload)
			.addClass("selected")
			.html(fileName);
	});

	// sweetalert2
	// alert ketika login dan input data
	const URLHref = window.location.href;
	const segment = URLHref.split("/");
	const flashData = $(".flash-data").attr("id");

	const nama = $(".navbar-dropdown__user-name").text();

	let lower = "";
	let upper = "";

	const alertSwal = function(segment) {
		lower += segment.replace("_", " ");
		upper += lower.charAt(0).toUpperCase() + lower.substring(1);
		if (flashData === "login") {
			swal({
				icon: "success",
				title: `Selamat datang ${upper} ${nama}`,
				timer: 2000
			});
		} else if (flashData === "menu-success") {
			const dataMenu = $("#menu-success").data("menu");
			swal({
				icon: "success",
				title: "Berhasil",
				text: `Menu ${dataMenu} berhasil ditambah!`,
				timer: 2000
			});
		}
	};

	if (flashData) {
		alertSwal(segment[4]);
	}

	// alert warning ketika logout
	const signout = $("#signout").attr("href");
	$("#signout").on("click", function(e) {
		e.preventDefault();
		swal({
			title: "Anda yakin",
			text: "ingin keluar?",
			icon: "warning",
			buttons: ["Tidak!", "Ya!"],
			dangerMode: true
		}).then(function(result) {
			if (result) {
				swal("Anda telah keluar!", {
					icon: "success",
					timer: 2000
				});
				setInterval(() => {
					document.location.href = signout;
				}, 2000);
			}
		});
	});

	// ajax pada halaman roleaccess
	const role = $("#role").text();
	$(".form-check-input").on("click", function() {
		const roleId = $(this).data("role");
		const menuId = $(this).data("menu");
		const baseurl = $(this).data("baseurl");
		// console.table([role, menu, baseurl]);
		$.ajax({
			url: `${baseurl}admin/changeaccess`,
			type: "post",
			data: {
				roleId: roleId,
				menuId: menuId
			},
			success: function() {
				document.location.href = `${baseurl}admin/roleaccess/${roleId}`;
			}
		});
	});
	if (flashData === "access-success") {
		swal({
			icon: "success",
			title: "Berhasil",
			text: `Akses ${role} berhasil diubah!`,
			timer: 3000
		});
	}
	setInterval(() => {
		$("#access-success").remove();
	}, 4000);

	if (flashData === "user-success") {
		swal({
			icon: "success",
			title: "Berhasil",
			text: `Profil ${nama} berhasil diubah!`,
			timer: 3000
		});
	}
	setInterval(() => {
		$("#user-success").remove();
	}, 4000);

	if (flashData === "foto-edit") {
		swal({
			icon: "success",
			title: "Berhasil",
			text: `Profil ${nama} berhasil diubah!`,
			timer: 3000
		});
	}
	setInterval(() => {
		$("#foto-edit").remove();
	}, 4000);

	// alert ketika ganti password
	if (flashData === "password-error") {
		swal({
			icon: "error",
			title: "Gagal!",
			text: $("#password-error").text(),
			timer: 3000
		});
	} else if (flashData === "password-lama-baru") {
		swal({
			icon: "error",
			title: "Gagal!",
			text: $("#password-lama-baru").text(),
			timer: 3000
		});
	} else if (flashData === "password-success") {
		swal({
			icon: "success",
			title: "Berhasil!",
			text: $("#password-success").text(),
			timer: 3000
		});
	}
	setInterval(() => {
		$(".flash-data").remove();
	}, 4000);

	// alert ketika tambah data error
	if ($(".error").hasClass("error")) {
		swal({
			icon: "error",
			title: "Oops...",
			text: "Ada yang salah! Mohon di isi dengan benar!",
			timer: 3000
		});
	}
	setInterval(() => {
		$(".error").remove();
	}, 4000);
})(jQuery);
