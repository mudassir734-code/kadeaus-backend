class AppointmentsManager {
  constructor(dashVista) {
    this.dashVista = dashVista;
    this.currentCarouselIndex = 0;
    this.carouselItemsPerView = 3;
    this.appointments = this.generateAppointmentData();

    this.init();
  }

  init() {
    this.initEventListeners();
    this.initWindowResize();
  }

  // Generate appointment mock data
  generateAppointmentData() {
    return [
      {
        id: 1,
        name: "Barbara Garrett",
        doctorName: "Dr George Lee",
        date: "06/26/2025",
        time: "08:00 am",
        visittype: "In Person",
        image: "./assets/img/Circle-8.png",
      },
      {
        id: 2,
        name: "Anthony Ellis",
        doctorName: "Dr George Lee",
        date: "06/26/2025",
        time: "09:00 am",
        visittype: "Video Call",
        image: "./assets/img/Circle.png",
      },
      {
        id: 3,
        name: "Danielle Gibson",
        doctorName: "Dr George Lee",
        date: "06/26/2025",
        time: "10:30 am",
        visittype: "In Person",
        image: "./assets/img/Circle-7.png",
      },
      {
        id: 4,
        name: "Tom Fuller",
        doctorName: "Dr George Lee",
        date: "06/26/2025",
        time: "11:00 am",
        visittype: "Video Call",
        image: "./assets/img/Circle-2.png",
      },
      {
        id: 5,
        name: "Sarah Johnson",
        doctorName: "Dr George Lee",
        date: "06/26/2025",
        time: "02:00 pm",
        visittype: "In Person",
        image: "./assets/img/Circle-3.png",
      },
      {
        id: 6,
        name: "Michael Brown",
        doctorName: "Dr George Lee",
        date: "06/26/2025",
        time: "03:30 pm",
        visittype: "Video Call",
        image: "./assets/img/Circle-3.png",
      },
    ];
  }

  // Initialize appointments event listeners
  initEventListeners() {
    const prevBtn = document.getElementById("prevCarousel");
    const nextBtn = document.getElementById("nextCarousel");

    if (prevBtn) {
      prevBtn.addEventListener("click", () => this.prevCarousel());
    }

    if (nextBtn) {
      nextBtn.addEventListener("click", () => this.nextCarousel());
    }

    // Handle appointment actions
    document.addEventListener("click", (e) => {
      if (e.target.matches(".accept-btn")) {
        const appointmentId = parseInt(
          e.target.closest(".appointment-card").dataset.appointmentId
        );
        this.acceptAppointment(appointmentId);
      } else if (e.target.matches(".reject-btn")) {
        const appointmentId = parseInt(
          e.target.closest(".appointment-card").dataset.appointmentId
        );
        this.rejectAppointment(appointmentId);
      }
    });
  }

  // Render appointments carousel
  render() {
    const carouselTrack = document.getElementById("carouselTrack");
    if (!carouselTrack) return;

    carouselTrack.innerHTML = "";

    this.appointments.forEach((appointment) => {
      const appointmentCard = this.createAppointmentCard(appointment);
      carouselTrack.appendChild(appointmentCard);
    });

    this.updateCarouselButtons();
  }

  // Create appointment card element
  createAppointmentCard(appointment) {
    const card = document.createElement("div");
    card.className = "appointment-card";
    card.dataset.appointmentId = appointment.id;

    // After generating the card content
    card.innerHTML = `
    <div class="card-header">
        <div class="user-profile-section">
            <div class="profile-image-container">
                <img src="${appointment.image}" alt="${appointment.name}" class="profile-image">
                <div class="status-indicator"></div>
            </div>
            <div class="user-name">${appointment.name}</div>
        </div>
        <button class="menu-btn">
            <i class="fas fa-ellipsis-h"></i>
        </button>
    </div>
    
    <div class="appointment-details">
        <div class="detail-row">
            <span class="detail-label">Doctor Name:</span>
            <span class="detail-value">${appointment.doctorName}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Appointment Date:</span>
            <span class="detail-value">${appointment.date}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Appointment Time:</span>
            <span class="detail-value">${appointment.time}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Visit Type:</span>
            <span class="detail-value">${appointment.visittype}</span>
        </div>
    </div>
    
    <div class="card-actions">
        <button class="action-btn accept-btn" data-bs-toggle="modal" data-bs-target="#assignDoctorModal">Accept</button>
        <button class="action-btn reject-btn">Reject</button>
    </div>
`;
    // Use event delegation to handle dynamic buttons
    document.addEventListener("click", function (e) {
      if (e.target && e.target.classList.contains("accept-btn")) {
        const myModal = new bootstrap.Modal(
          document.getElementById("acceptDoctorModal")
        );
        myModal.show();
      }
    });

    return card;
  }

  // Navigate to previous carousel items
  prevCarousel() {
    if (this.currentCarouselIndex > 0) {
      this.currentCarouselIndex--;
      this.updateCarousel();
    }
  }

  // Navigate to next carousel items
  nextCarousel() {
    const maxIndex = Math.max(
      0,
      this.appointments.length - this.carouselItemsPerView
    );
    if (this.currentCarouselIndex < maxIndex) {
      this.currentCarouselIndex++;
      this.updateCarousel();
    }
  }

  // Update carousel position
  updateCarousel() {
    const carouselTrack = document.getElementById("carouselTrack");
    if (!carouselTrack) return;

    const cardWidth = 280; // Card width + gap
    const translateX = -this.currentCarouselIndex * (cardWidth + 16);
    carouselTrack.style.transform = `translateX(${translateX}px)`;

    this.updateCarouselButtons();
  }

  // Update carousel navigation buttons state
  updateCarouselButtons() {
    const prevBtn = document.getElementById("prevCarousel");
    const nextBtn = document.getElementById("nextCarousel");

    if (prevBtn) {
      prevBtn.disabled = this.currentCarouselIndex === 0;
    }

    if (nextBtn) {
      const maxIndex = Math.max(
        0,
        this.appointments.length - this.carouselItemsPerView
      );
      nextBtn.disabled = this.currentCarouselIndex >= maxIndex;
    }
  }

  // Accept appointment
  acceptAppointment(appointmentId) {
    const appointment = this.appointments.find(
      (apt) => apt.id === appointmentId
    );
    if (appointment) {
      this.dashVista.showNotification(
        `Appointment with ${appointment.name} accepted!`,
        "success"
      );
      // Remove the appointment from the list
      this.appointments = this.appointments.filter(
        (apt) => apt.id !== appointmentId
      );
      this.render();
    }
  }

  // Reject appointment
  rejectAppointment(appointmentId) {
    const appointment = this.appointments.find(
      (apt) => apt.id === appointmentId
    );
    if (appointment) {
      this.dashVista.showNotification(
        `Appointment with ${appointment.name} rejected.`,
        "error"
      );
      // Remove the appointment from the list
      this.appointments = this.appointments.filter(
        (apt) => apt.id !== appointmentId
      );
      this.render();
    }
  }

  // Handle window resize for responsive carousel
  handleResize() {
    if (window.innerWidth <= 768) {
      this.carouselItemsPerView = 1;
    } else if (window.innerWidth <= 1024) {
      this.carouselItemsPerView = 2;
    } else {
      this.carouselItemsPerView = 3;
    }

    // Reset carousel position if needed
    const maxIndex = Math.max(
      0,
      this.appointments.length - this.carouselItemsPerView
    );
    if (this.currentCarouselIndex > maxIndex) {
      this.currentCarouselIndex = maxIndex;
    }

    this.updateCarousel();
  }

  // Add window resize listener
  initWindowResize() {
    window.addEventListener("resize", () => this.handleResize());
    // Set initial carousel items per view
    this.handleResize();
  }
}
