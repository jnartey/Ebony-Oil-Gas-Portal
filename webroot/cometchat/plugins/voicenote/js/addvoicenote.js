var request = {};
var audio_context;
var recorder;

var recordClick = (function (id) {
  var recordingCount = 0;
  return function (id) {
    recorder && recorder.record(id);
    recordingCount += 1;
    var recordingId = 'recording_container_'+recordingCount;
    jqcc('.audio_start').hide();

    $('.recording_frame').append("<div class='recording_container' id ='"+recordingId+"'><div class='audio_stop audio_css' onclick='stopRecording(this,id,"+recordingId+");'>Stop</div><div class='audio_cancel audio_css' onclick='cancelRecording(id,"+recordingId+");'>Cancel</div><div id='audiostop_overlay'><div id ='mp3_load'><img src='../../layouts/docked/images/loader_large.gif' height='50' width ='50' /></div></div></div>");
  }
})();

function stopRecording(button,div,container) {
  $("#audiostop_overlay").show();
  recorder && recorder.stop(div,container);
  button.disabled = true;
  createDownloadLink(div);
  recorder.clear();
}

function sendRecording(mp3,div) {
  fileTransfer(2,div,mp3);
}

function cancelRecording(_div,container) {
  recorder.clear();
  window.parent.jqcc('#cometchat_container_voicenote').remove();
}

function createDownloadLink(div) {
  recorder && recorder.exportWAV(function(blob) {
  });
}

function startUserMedia(stream) {
  var input = audio_context.createMediaStreamSource(stream);
  recorder = new Recorder(input);
}
function Uint8ArrayToFloat32Array(u8a){
  var f32Buffer = new Float32Array(u8a.length);
  for (var i = 0; i < u8a.length; i++) {
      var value = u8a[i<<1] + (u8a[(i<<1)+1]<<8);
      if (value >= 0x8000) value |= ~0x7FFF;
      f32Buffer[i] = value / 0x8000;
  }
  return f32Buffer;
}

window.onload = function init() {
  try {
    window.AudioContext = window.AudioContext || window.webkitAudioContext;
    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia;
    window.URL = window.URL || window.webkitURL;
    window.requestFileSystem  = window.requestFileSystem || window.webkitRequestFileSystem;

    audio_context = new AudioContext;
  } catch (e) {
    alert('No web audio support in this browser!');
  }
  if (window.File && window.FileList && window.FileReader) {
  }
  navigator.getUserMedia({audio: true}, startUserMedia, function(e) {

  });
};
