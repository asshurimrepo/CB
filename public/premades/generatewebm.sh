#!/bin/bash
for filename in *.mp4; do
    ffmpeg -i "$filename" -vcodec libvpx -preset veryfast -vf scale=1280:720 -acodec libvorbis "$filename.webm"
done