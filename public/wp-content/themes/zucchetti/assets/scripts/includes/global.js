(function ($, window, document) {
	var canBeLoaded = true;

	window.global = {
		setup: function () {
			this.toggleMobileFilters();
			this.blogTabber();
			this.blogTOC();
			this.wrapTablesInDiv();
		},

		wrapTablesInDiv: function () {
			var sectionContents = document.querySelectorAll(
				".single-post .post-content .content-inner"
			);

			if (sectionContents) {
				sectionContents.forEach(function (sectionContent) {
					var tables = sectionContent.querySelectorAll("table");

					tables.forEach(function (table) {
						var div = document.createElement("div");
						div.className = "responsive-table";
						table.parentNode.insertBefore(div, table);
						div.appendChild(table);
					});
				});
			}
		},

		toggleMobileFilters: function () {
			var toggleButton = document.querySelector(
				".dakota-toggle-mobile-filters"
			);
			var sidebar = document.querySelector("#sidebar");

			if (toggleButton && sidebar) {
				var toggleButtonText = toggleButton.querySelector("span");

				toggleButton.addEventListener("click", function () {
					sidebar.classList.toggle("open");

					var isOpen = sidebar.classList.contains("open");
					toggleButtonText.textContent = isOpen
						? "Hide Filters"
						: "Show Filters";
				});
			}
		},

		tnsArrows: function () {
			var arrows = [
				'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 17.1"><path d="M10 1L9 0 0 8.5l9 8.6 1-1-8-7.6L10 1z"/></svg>',
				'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 17.1"><path d="M0 16.1l1 1 9-8.6L1 0 0 1l8 7.5-8 7.6z"/></svg>',
			];
			return arrows;
		},

		blogTabber: function () {
			var tabTitles = document.querySelectorAll(
				".hc-blog-sidebar-tabber--tab_title"
			);
			var tabs = document.querySelectorAll(
				".hc-blog-sidebar-tabber--tab"
			);

			// Add initial styles
			tabs.forEach(function (tab) {
				tab.style.transition = "opacity 0.3s ease-in-out";
				tab.style.opacity = tab.style.display === "none" ? "0" : "1";
			});

			tabTitles.forEach(function (title) {
				title.addEventListener("click", function () {
					var target = this.getAttribute("data-target");

					// Update active state for titles
					tabTitles.forEach(function (t) {
						t.classList.remove("active");
					});
					this.classList.add("active");

					// Fade out all tabs, then fade in the target tab
					tabs.forEach(function (tab) {
						tab.style.opacity = "0";
						setTimeout(function () {
							tab.style.display = "none";
							if (tab.getAttribute("data-tab") === target) {
								tab.style.display = "block";
								setTimeout(function () {
									tab.style.opacity = "1";
								}, 50);
							}
						}, 100);
					});
				});
			});
		},

		blogTOC: function () {
			var tocTitle = $(".hc-blog-single--toc_title");
			if (tocTitle.length) {
				tocTitle.on("click", function () {
					$(this).toggleClass("open");
					if ($(window).width() < 1024) {
						$(".hc-blog-single--toc_items")
							.stop(true, true)
							.slideToggle()
							.toggleClass("open");
					}
				});
			}

			// Table of contents
			var body = document.querySelector(".single-post .content-inner");
			if (!body) return; // exit if content-inner isn't present

			var headings = body.querySelectorAll("h2");
			if (!headings.length) return; // exit if no headings

			var toc = document.querySelector(".hc-blog-single--toc_items");
			if (!toc) return; // exit if TOC container doesn't exist

			// Offset to account for sticky headers or featured image negative margin
			var offset = 130;
			var negativeMargin = 250;
			var totalOffset = offset + negativeMargin;

			headings.forEach(function (heading, index) {
				var id = "section-" + (index + 1);
				heading.id = id;

				var tocItem = document.createElement("li");
				var tocLink = document.createElement("a");

				tocLink.href = "#" + id;
				tocLink.textContent = heading.textContent;
				tocItem.appendChild(tocLink);
				toc.appendChild(tocItem);

				tocLink.addEventListener("click", function (event) {
					event.preventDefault();
					var targetElement = document.getElementById(id);
					if (!targetElement) return;
					var targetPosition =
						targetElement.getBoundingClientRect().top +
						window.pageYOffset -
						totalOffset;
					window.scrollTo({
						top: targetPosition,
						behavior: "smooth",
					});
				});
			});

			// Highlight current section in TOC on scroll
			window.addEventListener("scroll", function () {
				var tocLinks = toc.querySelectorAll("a");
				var scrollPosition = window.scrollY + totalOffset;

				var currentSection = headings[0];
				headings.forEach(function (heading) {
					var headingPosition =
						heading.getBoundingClientRect().top +
						window.pageYOffset -
						totalOffset;
					if (scrollPosition >= headingPosition) {
						currentSection = heading;
					}
				});

				tocLinks.forEach(function (link) {
					link.classList.toggle(
						"active",
						link.getAttribute("href") === "#" + currentSection.id
					);
				});
			});
		},
	};
})(window.jQuery, window, document);
