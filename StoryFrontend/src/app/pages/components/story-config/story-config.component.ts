import { Component, ElementRef, ViewChild } from '@angular/core';

@Component({
  selector: 'app-story-config',
  templateUrl: './story-config.component.html',
  styleUrls: ['./story-config.component.css']
})
export class StoryConfigComponent {
  @ViewChild('myCanvas') canvas!: ElementRef;
  private ctx!: CanvasRenderingContext2D;
  private image!: HTMLImageElement;

  constructor() { }

  ngAfterViewInit() {
    this.ctx = this.canvas.nativeElement.getContext('2d');
    this.image = new Image();
    this.image.src = '/assets/images/pages/m7ONzmMXmQkaJ8mj3jrSdI1672904703799_trong.png';
    this.image.onload = () => {
      this.resizeAndDrawImage();
    };
  }

  resizeAndDrawImage() {
    // const maxWidth = window.innerWidth; // Maximum width of the screen
    // const maxHeight = window.innerHeight; // Maximum height of the screen

    const maxWidth = 1000;
    const maxHeight = 500;

    // Calculate scaling factors to fit the image inside the canvas
    const scaleWidth = maxWidth / this.image.width;
    const scaleHeight = maxHeight / this.image.height;

    // Choose the minimum scaling factor to fit the entire image inside the canvas
    const scaleFactor = Math.min(scaleWidth, scaleHeight);

    // Calculate the new dimensions
    const newWidth = this.image.width * scaleFactor;
    const newHeight = this.image.height * scaleFactor;

    // Clear the canvas
    this.ctx.clearRect(0, 0, this.canvas.nativeElement.width, this.canvas.nativeElement.height);

    // Draw the resized image
    this.ctx.drawImage(this.image, 0, 0, newWidth, newHeight);
  }

  onCanvasMouseDown(event: MouseEvent) {
    const x = event.offsetX;
    const y = event.offsetY;

    // Vẽ điểm chạm tại vị trí được nhấp
    this.ctx.beginPath();
    this.ctx.arc(x, y, 5, 0, 2 * Math.PI);
    this.ctx.fillStyle = 'red';
    this.ctx.fill();
    this.ctx.closePath();
  }
}
