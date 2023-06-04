window.addEventListener("DOMContentLoaded", () => {
  if (!window.location.pathname.includes("/watch/")) {
    const topBar = document.querySelector(".topBar");

    function toggleScrolled() {
      topBar.classList.toggle("scrolled", window.scrollY > topBar.offsetHeight);
    }

    toggleScrolled();

    window.addEventListener("scroll", toggleScrolled);
  }
});

function volumeToggle(button) {
  const video = document.querySelector(".previewVideo");
  video.muted = !video.muted;

  const iconElement = button.querySelector("i");

  if (video.muted) {
    iconElement.classList.remove("fa-volume-up");
    iconElement.classList.add("fa-volume-off");
  } else {
    iconElement.classList.remove("fa-volume-off");
    iconElement.classList.add("fa-volume-up");
  }
}

function goBack() {
  window.history.back();
}

function startHideTimer() {
  let timeout = null;
  const watchNav = document.querySelector(".watchNav");

  document.addEventListener("mousemove", () => {
    clearTimeout(timeout);
    watchNav.style.opacity = 1;

    timeout = setTimeout(() => {
      watchNav.style.opacity = 0;
    }, 2000);
  });
}

function initVideo(videoId, userId) {
  startHideTimer();
  updateProgressTimer(videoId, userId);
}

function updateProgressTimer(videoId, userId) {
  addDuration(videoId, userId);

  let timer;

  document.querySelector("video").addEventListener("playing", function (event) {
    clearInterval(timer);
    timer = setInterval(function () {
      updateProgress(videoId, userId, event.target.currentTime);
    }, 3000);
  });
  document.querySelector("video").addEventListener("ended", function () {
    setFinished(videoId, userId);
    clearInterval(timer);
  });
}

function addDuration(videoId, userId) {
  fetch("/api/videoProgress", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ videoId: videoId, userId: userId }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (
        data !== null &&
        data !== "" &&
        data === "No videoId or userId passed into file"
      ) {
        alert(data);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function updateProgress(videoId, userId, progress) {
  fetch("/api/videoProgress", {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      videoId: videoId,
      userId: userId,
      progress: progress,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (
        data !== null &&
        data !== "" &&
        data === "No videoId or userId passed into file"
      ) {
        alert(data);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function setFinished(videoId, userId) {
  fetch("/api/videoProgress", {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      videoId: videoId,
      userId: userId,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (
        data !== null &&
        data !== "" &&
        data === "No videoId or userId passed into file"
      ) {
        alert(data);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function restartVideo() {
  const videoElement = document.querySelector("video");
  videoElement.currentTime = 0;
  videoElement.play();
  const upNextElement = document.querySelector(".upNext");
  upNextElement.style.display = "none";
}

function watchVideo(videoId) {
  window.location.href = `/watch/${videoId}`;
}

function showUpNext() {
  const upNextElement = document.querySelector(".upNext");
  upNextElement.classList.add("fadeIn");
  upNextElement.style.display = "block";
}
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};
