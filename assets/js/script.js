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
  const videoElement = document.querySelector(".previewVideo");
  const imageElement = document.querySelector(".previewImage");

  videoElement.addEventListener("ended", function () {
    videoElement.classList.toggle("hidden");
    imageElement.classList.toggle("hidden");
  });
}
