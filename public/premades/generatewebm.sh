#!/bin/bash
for filename in *.mov; do
    ffmpeg -i "$filename" -b:v 0.85M -q:v 10 -vcodec libvpx -vf scale=640:720 -acodec libvorbis "$filename.webm"
done