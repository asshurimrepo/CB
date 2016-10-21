#!/bin/bash
for filename in *.mp4; do
    ffmpeg -i "$filename" -vcodec libvpx -preset veryfast -vf scale=1000:720 -threads 2  -acodec libvorbis "$filename.webm"
done