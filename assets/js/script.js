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
function previewEnded() {
  const video = document.querySelector(".previewVideo");
  const image = document.querySelector(".previewImage");

  video.addEventListener("ended", function () {
    video.classList.toggle("hidden");
    image.classList.toggle("hidden");
  });
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
}

function addDuration(videoId, userId) {
  fetch("/api/progress", {
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
  fetch("/api/progress", {
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
