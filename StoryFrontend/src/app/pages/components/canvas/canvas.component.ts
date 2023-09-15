import { Component, ElementRef, Input, ViewChild } from '@angular/core';
import { FormControl } from '@angular/forms';
import { CanvasService } from 'src/app/core/services/canvas.service';

@Component({
  selector: 'app-canvas',
  templateUrl: './canvas.component.html',
  styleUrls: ['./canvas.component.css']
})
export class CanvasComponent {
  @ViewChild('canvasComponent') canvas!: ElementRef;
  private ctx!: CanvasRenderingContext2D;
  private image!: HTMLImageElement;

  private rectangles: any[] = [];
  private current_shape_index: any;
  private is_dragging = false;
  private is_drawing = false;

  private startX: any;
  private startY: any;
  private offsetX: any;
  private offsetY: any;

  @Input() imageSource!: string;

  constructor(
    private canvasService: CanvasService
  ) { }

  ngAfterViewInit() {
    this.ctx = this.canvas.nativeElement.getContext('2d');

    this.image = new Image();
    this.image.src = this.imageSource;

    //get rectangles source here

    this.image.onload = () => {
      this.resizeAndDrawImage();
      this.drawShape();

    };



  }

  resizeAndDrawImage() {
    const maxWidth = this.canvas.nativeElement.width;
    const maxHeight = this.canvas.nativeElement.height;

    // Calculate scaling factors to fit the image inside the canvas
    const scaleWidth = maxWidth / this.image.width;
    const scaleHeight = maxHeight / this.image.height;
    const scaleFactor = Math.min(scaleWidth, scaleHeight);

    // Calculate the new dimensions
    const newWidth = this.image.width * scaleFactor;
    const newHeight = this.image.height * scaleFactor;

    // Clear the canvas
    this.ctx.clearRect(0, 0, this.canvas.nativeElement.width, this.canvas.nativeElement.height);

    // Draw the resized image
    this.ctx.drawImage(this.image, 0, 0, newWidth, newHeight);

  }

  drawShape() {
    this.resizeAndDrawImage();
    this.rectangles.forEach(rect => {
      this.ctx.strokeStyle = 'red';
      this.ctx.strokeRect(rect.x, rect.y, rect.width, rect.height);
    });
  }

  onCanvasMouseDown(event: MouseEvent) {
    this.startX = event.offsetX;
    this.startY = event.offsetY;

    let index = 0;
    this.rectangles.forEach(rect => {
      if (this.isMouseInShape(this.startX, this.startY, rect)) {
        this.current_shape_index = index;
        this.is_dragging = true;
        return;
      }
      index++;
    });

    if (!this.is_dragging) {
      this.is_drawing = true;
    }


  }

  onCanvasMouseMove(event: MouseEvent) {
    this.offsetX = event.offsetX;
    this.offsetY = event.offsetY;

    if (this.is_drawing) {
      this.ctx.clearRect(0, 0, this.canvas.nativeElement.width, this.canvas.nativeElement.height);
      this.drawShape();

      const width = this.offsetX - this.startX;
      const height = this.offsetY - this.startY;
      this.ctx.strokeRect(this.startX, this.startY, width, height);

    } else if (this.is_dragging) {

      const dx = this.offsetX - this.startX;
      const dy = this.offsetY - this.startY;

      const current_shape = this.rectangles[this.current_shape_index];
      current_shape.x += dx;
      current_shape.y += dy;

      this.drawShape();

      this.startX = this.offsetX;
      this.startY = this.offsetY;
    }
  }

  onCanvasMouseUp() {
    if (!this.is_dragging && !this.is_drawing) {
      return;
    }
    if (this.is_drawing && this.offsetX - this.startX != 0 && this.offsetY - this.startY != 0) {
      this.rectangles.push({ x: this.startX, y: this.startY, width: Math.abs(this.offsetX - this.startX), height: Math.abs(this.offsetY - this.startY) });
      console.log(this.rectangles);
      this.current_shape_index = this.rectangles.length - 1;
      this.drawShape();
    }
    this.is_dragging = false;
    this.is_drawing = false;

    const current_shape = this.rectangles[this.current_shape_index];
    if (current_shape) {
      console.log(current_shape.x, current_shape.y, current_shape.width, current_shape.height);
    }


  }

  isMouseInShape(x: Number, y: Number, shape: any) {
    const shapeLeft = shape.x;
    const shapeRight = shape.x + shape.width;
    const shapeTop = shape.y;
    const shapeBottom = shape.y + shape.height;

    if (x > shapeLeft && x < shapeRight && y > shapeTop && y < shapeBottom) {
      return true;
    }
    return false;
  }

  undo() {
    this.rectangles.pop();
    this.drawShape();
  }

  clear() {
    this.rectangles = [];
    this.drawShape();
  }

  remove() {
    if (this.current_shape_index >= 0 && this.current_shape_index < this.rectangles.length) {
      this.rectangles.splice(this.current_shape_index, 1);
      this.drawShape();
    }
  }

  myControl = new FormControl('');
  options: string[] = ['One', 'Two', 'Three'];

  getCurrentShape() {
    const current_shape = this.rectangles[this.current_shape_index];
    if (current_shape) return current_shape;
    return null;
  }


}
