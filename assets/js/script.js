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
