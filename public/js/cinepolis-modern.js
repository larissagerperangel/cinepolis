// Clase principal para manejar la interactividad
class CinepolisInteractive {
  constructor() {
    this.setupEventListeners()
    this.initializeComponents()
  }

  setupEventListeners() {
    // Inicializar cuando el DOM esté listo
    document.addEventListener("DOMContentLoaded", () => {
      this.initializeCarousel()
      this.initializeGenreFilter()
      this.initializeBookingSystem()
      this.initializeContactForm()
      this.initializeNewsletterForm()
    })
  }

  initializeComponents() {
    // Componentes que se inicializan en todas las páginas
    this.initializeTooltips()
    this.initializeDropdowns()
  }

  // Inicializa el carrusel con opciones avanzadas
  initializeCarousel() {
    const carousel = document.getElementById("Carousel")
    if (carousel) {
      // Opciones avanzadas para el carrusel
      const carouselInstance = new bootstrap.Carousel(carousel, {
        interval: 5000,
        wrap: true,
        touch: true,
        keyboard: true,
      })

      // Añadir indicadores dinámicos
      const items = carousel.querySelectorAll(".carousel-item")
      if (items.length > 0) {
        const indicatorsContainer = document.createElement("div")
        indicatorsContainer.className = "carousel-indicators"

        items.forEach((_, index) => {
          const indicator = document.createElement("button")
          indicator.type = "button"
          indicator.setAttribute("data-bs-target", "#Carousel")
          indicator.setAttribute("data-bs-slide-to", index.toString())
          if (index === 0) {
            indicator.className = "active"
            indicator.setAttribute("aria-current", "true")
          }
          indicator.setAttribute("aria-label", `Slide ${index + 1}`)

          indicatorsContainer.appendChild(indicator)
        })

        carousel.appendChild(indicatorsContainer)
      }

      // Añadir efecto de transición mejorado
      items.forEach((item) => {
        item.addEventListener("transitionend", () => {
          if (item.classList.contains("active")) {
            const heading = item.querySelector("h2")
            const paragraph = item.querySelector("p")
            const buttons = item.querySelectorAll(".btn")

            if (heading) heading.classList.add("animate__animated", "animate__fadeInUp")
            if (paragraph) paragraph.classList.add("animate__animated", "animate__fadeInUp")
            buttons.forEach((button) => button.classList.add("animate__animated", "animate__fadeInUp"))
          }
        })
      })
    }
  }

  // Filtro de géneros en la página de cartelera
  initializeGenreFilter() {
    const genreTabs = document.getElementById("genreTabs")
    if (genreTabs) {
      const tabButtons = genreTabs.querySelectorAll(".nav-link")
      const movieCards = document.querySelectorAll(".movie-card")

      tabButtons.forEach((button) => {
        button.addEventListener("click", (e) => {
          e.preventDefault()

          // Desactivar todos los botones
          tabButtons.forEach((btn) => btn.classList.remove("active"))

          // Activar el botón actual
          button.classList.add("active")

          const selectedGenre = button.getAttribute("data-genre") || button.textContent.trim()

          // Filtrar películas
          movieCards.forEach((card) => {
            const cardGenre = card.getAttribute("data-genre")

            if (selectedGenre === "Todas" || selectedGenre === cardGenre) {
              card.style.display = "block"
              // Añadir animación
              card.classList.add("animate__animated", "animate__fadeIn")
            } else {
              card.style.display = "none"
            }
          })
        })
      })
    }
  }

  // Sistema de reservas mejorado
  initializeBookingSystem() {
    // Variables para la página de reservas
    const dayButtons = document.querySelectorAll(".day-button")
    const timeButtons = document.querySelectorAll(".time-button")
    const seatButtons = document.querySelectorAll(".seat-button:not([disabled])")
    const decreaseSeatsBtn = document.getElementById("decrease-seats")
    const increaseSeatsBtn = document.getElementById("increase-seats")
    const seatsCountEl = document.getElementById("seats-count")
    const selectedDayTimeEl = document.getElementById("selected-day-time")
    const selectedSeatsCountEl = document.getElementById("selected-seats-count")
    const totalPriceEl = document.getElementById("total-price")
    const continueToPaymentBtn = document.getElementById("continue-to-payment")
    const paymentTab = document.getElementById("payment-tab")
    const backToSeatsBtn = document.getElementById("back-to-seats")
    const selectedSeatsInput = document.getElementById("selected-seats")

    // Si no estamos en la página de reservas, salir
    if (!dayButtons.length || !timeButtons.length) return

    // Estado de la reserva
    const state = {
      day: Number.parseInt(new URLSearchParams(window.location.search).get("day") || 0),
      time: new URLSearchParams(window.location.search).get("time") || "",
      maxSeats: 10,
      seatsCount: 2,
      selectedSeats: [],
      seatPrice: 7.5,
    }

    // Función para actualizar la interfaz
    function updateUI() {
      // Actualizar botones de día
      dayButtons.forEach((btn) => {
        const day = Number.parseInt(btn.getAttribute("data-day"))
        if (day === state.day) {
          btn.classList.add("btn-danger")
          btn.classList.remove("btn-outline-secondary")
        } else {
          btn.classList.remove("btn-danger")
          btn.classList.add("btn-outline-secondary")
        }
      })

      // Actualizar botones de hora
      timeButtons.forEach((btn) => {
        const time = btn.getAttribute("data-time")
        if (time === state.time) {
          btn.classList.add("btn-danger")
          btn.classList.remove("btn-outline-secondary")
        } else {
          btn.classList.remove("btn-danger")
          btn.classList.add("btn-outline-secondary")
        }
      })

      // Actualizar contador de asientos
      if (seatsCountEl) seatsCountEl.textContent = state.seatsCount

      // Actualizar día y hora seleccionados
      const days = ["Hoxe", "Mañá", "Pasado mañá"]
      if (selectedDayTimeEl) selectedDayTimeEl.textContent = `${days[state.day]} - ${state.time}`

      // Actualizar asientos seleccionados
      seatButtons.forEach((btn) => {
        const seat = btn.getAttribute("data-seat")
        if (state.selectedSeats.includes(seat)) {
          btn.classList.add("selected")
        } else {
          btn.classList.remove("selected")
        }
      })

      // Actualizar contador de asientos seleccionados y precio total
      if (selectedSeatsCountEl) selectedSeatsCountEl.textContent = state.selectedSeats.length
      if (totalPriceEl) totalPriceEl.textContent = `${(state.selectedSeats.length * state.seatPrice).toFixed(2)} €`

      // Actualizar botón de continuar
      if (continueToPaymentBtn) {
        continueToPaymentBtn.disabled = state.selectedSeats.length === 0 || state.time === ""
      }

      // Actualizar campos ocultos del formulario
      if (selectedSeatsInput) selectedSeatsInput.value = JSON.stringify(state.selectedSeats)
    }

    // Event Listeners
    dayButtons.forEach((btn) => {
      btn.addEventListener("click", function () {
        state.day = Number.parseInt(this.getAttribute("data-day"))
        updateUI()
      })
    })

    timeButtons.forEach((btn) => {
      btn.addEventListener("click", function () {
        state.time = this.getAttribute("data-time")
        updateUI()
      })
    })

    if (decreaseSeatsBtn) {
      decreaseSeatsBtn.addEventListener("click", () => {
        if (state.seatsCount > 1) {
          state.seatsCount--
          // Si tenemos más asientos seleccionados que el nuevo límite, eliminar los últimos
          if (state.selectedSeats.length > state.seatsCount) {
            state.selectedSeats = state.selectedSeats.slice(0, state.seatsCount)
          }
          updateUI()
        }
      })
    }

    if (increaseSeatsBtn) {
      increaseSeatsBtn.addEventListener("click", () => {
        if (state.seatsCount < state.maxSeats) {
          state.seatsCount++
          updateUI()
        }
      })
    }

    seatButtons.forEach((btn) => {
      btn.addEventListener("click", function () {
        const seat = this.getAttribute("data-seat")
        const index = state.selectedSeats.indexOf(seat)

        if (index > -1) {
          // El asiento ya está seleccionado, quitarlo
          state.selectedSeats.splice(index, 1)
        } else if (state.selectedSeats.length < state.seatsCount) {
          // El asiento no está seleccionado y no hemos alcanzado el límite
          state.selectedSeats.push(seat)
        }

        updateUI()
      })
    })

    if (continueToPaymentBtn) {
      continueToPaymentBtn.addEventListener("click", function () {
        if (!this.disabled && paymentTab) {
          paymentTab.click()
        }
      })
    }

    if (backToSeatsBtn) {
      backToSeatsBtn.addEventListener("click", () => {
        if (document.getElementById("seats-tab")) {
          document.getElementById("seats-tab").click()
        }
      })
    }

    // Inicializar UI
    updateUI()

    // Añadir validación de formulario de pago
    const bookingForm = document.getElementById("booking-form")
    if (bookingForm) {
      bookingForm.addEventListener(
        "submit",
        function (e) {
          const cardNumber = document.getElementById("card-number")
          const expiry = document.getElementById("expiry")
          const cvv = document.getElementById("cvv")

          if (cardNumber && expiry && cvv) {
            // Validar número de tarjeta
            const cardNumberValue = cardNumber.value.replace(/\s/g, "")
            if (!/^\d{16}$/.test(cardNumberValue)) {
              e.preventDefault()
              this.showError(cardNumber, "Introduce un número de tarjeta válido de 16 dígitos")
              return
            }

            // Validar fecha de caducidad
            if (!/^\d{2}\/\d{2}$/.test(expiry.value)) {
              e.preventDefault()
              this.showError(expiry, "Introduce una fecha válida (MM/AA)")
              return
            }

            // Validar CVV
            if (!/^\d{3}$/.test(cvv.value)) {
              e.preventDefault()
              this.showError(cvv, "Introduce un CVV válido de 3 dígitos")
              return
            }
          }
        }.bind(this),
      )
    }
  }

  // Formulario de contacto con validación y AJAX
  initializeContactForm() {
    const contactForm = document.getElementById("contact-form")
    if (contactForm) {
      contactForm.addEventListener(
        "submit",
        function (e) {
          e.preventDefault()

          // Validar formulario
          if (!this.validateForm(contactForm)) {
            return
          }

          // Obtener token CSRF
          const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content

          // Enviar formulario con AJAX
          const formData = new FormData(contactForm)

          // Mostrar indicador de carga
          const submitButton = contactForm.querySelector('button[type="submit"]')
          const originalButtonText = submitButton.innerHTML
          submitButton.disabled = true
          submitButton.innerHTML =
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando...'

          fetch("/contacto", {
            method: "POST",
            body: formData,
            headers: {
              "X-CSRF-TOKEN": csrfToken,
            },
          })
            .then((response) => {
              if (!response.ok) {
                throw new Error("Error al enviar el mensaje")
              }
              return response.json()
            })
            .then((data) => {
              // Mostrar mensaje de éxito
              this.showNotification("Mensaxe enviada con éxito!", "success")
              contactForm.reset()
            })
            .catch((error) => {
              // Mostrar mensaje de error
              this.showNotification("Error al enviar el mensaje", "error")
            })
            .finally(() => {
              // Restaurar botón
              submitButton.disabled = false
              submitButton.innerHTML = originalButtonText
            })
        }.bind(this),
      )
    }
  }

  // Formulario de suscripción
  initializeNewsletterForm() {
    const newsletterForms = document.querySelectorAll('form[id^="newsletter-form"]')

    newsletterForms.forEach((form) => {
      form.addEventListener(
        "submit",
        function (e) {
          e.preventDefault()

          // Validar email
          const emailInput = form.querySelector('input[type="email"]')
          if (!emailInput || !this.validateEmail(emailInput.value)) {
            this.showError(emailInput, "Introduce un email válido")
            return
          }

          // Mostrar mensaje de éxito
          const successMessage = form.nextElementSibling
          if (successMessage && successMessage.classList.contains("alert")) {
            successMessage.classList.remove("d-none")
            form.reset()

            // Ocultar después de 4 segundos
            setTimeout(() => {
              successMessage.classList.add("d-none")
            }, 4000)
          } else {
            this.showNotification("Subscrición realizada con éxito!", "success")
            form.reset()
          }
        }.bind(this),
      )
    })
  }

  // Inicializar tooltips de Bootstrap
  initializeTooltips() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map((tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl))
  }

  // Inicializar dropdowns (linea de subrayado con movimiento) de Bootstrap
  initializeDropdowns() {
    const dropdownTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'))
    dropdownTriggerList.map((dropdownTriggerEl) => new bootstrap.Dropdown(dropdownTriggerEl))
  }

  // Validar formulario
  validateForm(form) {
    let isValid = true

    // Validar campos requeridos
    const requiredFields = form.querySelectorAll("[required]")
    requiredFields.forEach((field) => {
      if (!field.value.trim()) {
        this.showError(field, "Este campo es obligatorio")
        isValid = false
      } else {
        this.clearError(field)

        // Validar email
        if (field.type === "email" && !this.validateEmail(field.value)) {
          this.showError(field, "Introduce un email válido")
          isValid = false
        }
      }
    })

    return isValid
  }

  // Validar email
  validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    return re.test(email)
  }

  // Mostrar error en campo
  showError(field, message) {
    // Limpiar error previo
    this.clearError(field)

    // Añadir clase de error
    field.classList.add("is-invalid")

    // Crear mensaje de error
    const errorDiv = document.createElement("div")
    errorDiv.className = "invalid-feedback"
    errorDiv.textContent = message

    // Insertar mensaje después del campo
    field.parentNode.appendChild(errorDiv)
  }

  // Limpiar error
  clearError(field) {
    field.classList.remove("is-invalid")

    // Eliminar mensaje de error si existe
    const errorDiv = field.parentNode.querySelector(".invalid-feedback")
    if (errorDiv) {
      errorDiv.remove()
    }
  }

  // Mostrar notificación
  showNotification(message, type = "info") {
    const notification = document.createElement("div")
    notification.className = `alert alert-${type === "error" ? "danger" : "success"} alert-dismissible fade show position-fixed`
    notification.style.cssText = "top: 20px; right: 20px; z-index: 9999; min-width: 300px;"
    notification.innerHTML = `
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `

    document.body.appendChild(notification)

    // Eliminar después de 5 segundos
    setTimeout(() => {
      notification.remove()
    }, 5000)
  }
}

// Inicializar la aplicación cuando el DOM esté listo
document.addEventListener("DOMContentLoaded", () => {
  new CinepolisInteractive()
})

// Añadir efectos visuales a elementos específicos
document.addEventListener("DOMContentLoaded", () => {
  // Efecto de hover en las tarjetas de películas
  const movieCards = document.querySelectorAll(".card")
  movieCards.forEach((card) => {
    card.addEventListener("mouseenter", () => {
      card.classList.add("shadow-lg")
      card.style.transform = "translateY(-5px)"
      card.style.transition = "transform 0.3s ease, box-shadow 0.3s ease"
    })

    card.addEventListener("mouseleave", () => {
      card.classList.remove("shadow-lg")
      card.style.transform = "translateY(0)"
    })
  })

  // Efecto de scroll suave para enlaces internos
  const internalLinks = document.querySelectorAll('a[href^="#"]')
  internalLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      const targetId = this.getAttribute("href")
      if (targetId === "#") return

      const targetElement = document.querySelector(targetId)
      if (targetElement) {
        e.preventDefault()
        window.scrollTo({
          top: targetElement.offsetTop - 100,
          behavior: "smooth",
        })
      }
    })
  })
})