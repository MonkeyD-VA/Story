import { Component, ElementRef, Input, ViewChild } from '@angular/core';
import { FormControl } from '@angular/forms';
import { MatDialog, MatDialogConfig } from '@angular/material/dialog';
import { ActivatedRoute } from '@angular/router';
import { PageService } from 'src/app/core/services/componentServices/page.service';
import { PositionService } from 'src/app/core/services/componentServices/position.service';
import { TextService } from 'src/app/core/services/componentServices/text.service';
import { CreateTouchDialogComponent } from '../create-touch-dialog/create-touch-dialog.component';
import { DialogConfig } from '@angular/cdk/dialog';

@Component({
  selector: 'app-canvas',
  templateUrl: './canvas.component.html',
  styleUrls: ['./canvas.component.css'],
})
export class CanvasComponent {
  @ViewChild('canvasComponent') canvas!: ElementRef;
  private ctx!: CanvasRenderingContext2D;
  private image!: HTMLImageElement;

  private positions: any[] = [];
  private current_shape_index: any;
  private is_dragging = false;
  private is_drawing = false;

  private startX: any;
  private startY: any;
  private offsetX: any;
  private offsetY: any;
  private screenX: any;
  private screenY: any;

  @Input() imageSource!: string;
  @Input() pageNumber!: number;

  options: string[] = [];
  selectedOption!: string;
  selectedTextId!: number;

  private touches: any[] = [];
  private pageId!: number;

  constructor(
    private textService: TextService,
    private pageService: PageService,
    private route: ActivatedRoute,
    private positionService: PositionService,
    private dialog: MatDialog
  ) {}

  ngOnInit(): void {
    //get the story id from current route
    const routeParams = this.route.snapshot.paramMap;
    const storyIdFromRoute = Number(routeParams.get('id'));

    //get text data to options
    this.textService.getAll().subscribe((response) => {
      this.options = response.data.data;
    });

    this.pageService
      .getAllOfPage(storyIdFromRoute, this.pageNumber)
      .subscribe((response) => {
        //get data position in database
        if (response.data.length) {
          this.pageId = response.data[0].page_id;
          this.positionService
            .getPositionInPage(this.pageId)
            .subscribe((res) => {
              this.positions = res.data.positions;
              if (res.data.positions) {
                this.touches.push({
                  positions: this.positions,
                  page_id: res.data.page_id,
                  text_id: res.data.text_id,
                });
              }
            });
        }
      });
  }

  ngAfterViewInit() {
    this.ctx = this.canvas.nativeElement.getContext('2d');

    this.image = new Image();
    this.image.src = this.imageSource;

    //get positions source here

    this.image.onload = () => {
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
    this.screenX = this.image.width * scaleFactor;
    this.screenY = this.image.height * scaleFactor;

    // Clear the canvas
    this.ctx.clearRect(
      0,
      0,
      this.canvas.nativeElement.width,
      this.canvas.nativeElement.height
    );

    // Draw the resized image
    this.ctx.drawImage(this.image, 0, 0, this.screenX, this.screenY);
  }

  drawShape() {
    this.resizeAndDrawImage();
    this.positions.forEach((rect) => {
      this.ctx.strokeStyle = 'red';
      this.ctx.strokeRect(rect.x, rect.y, rect.width, rect.height);
    });
  }

  onCanvasMouseDown(event: MouseEvent) {
    this.startX = event.offsetX;
    this.startY = event.offsetY;

    let index = 0;
    this.positions.forEach((rect) => {
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
      this.ctx.clearRect(
        0,
        0,
        this.canvas.nativeElement.width,
        this.canvas.nativeElement.height
      );
      this.drawShape();

      const width = this.offsetX - this.startX;
      const height = this.offsetY - this.startY;
      this.ctx.strokeRect(this.startX, this.startY, width, height);
    } else if (this.is_dragging) {
      const dx = this.offsetX - this.startX;
      const dy = this.offsetY - this.startY;

      const current_shape = this.positions[this.current_shape_index];
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
    if (
      this.is_drawing &&
      this.offsetX - this.startX != 0 &&
      this.offsetY - this.startY != 0
    ) {
      this.positions.push({
        x: this.startX,
        y: this.startY,
        width: Math.abs(this.offsetX - this.startX),
        height: Math.abs(this.offsetY - this.startY),
      });
      this.current_shape_index = this.positions.length - 1;
      this.drawShape();
      this.openDialog();
    }
    this.is_dragging = false;
    this.is_drawing = false;
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
    this.positions.pop();
    this.drawShape();
  }

  clear() {
    this.positions = [];
    this.drawShape();
  }

  remove() {
    if (
      this.current_shape_index >= 0 &&
      this.current_shape_index < this.positions.length
    ) {
      this.positions.splice(this.current_shape_index, 1);
      this.drawShape();
    }
  }

  save() {
    this.positionService
      .createPositionByTouch(this.touches)
      .subscribe((response) => {
        alert('Update success');
      });
  }

  loadRect() {
    this.drawShape();
  }

  myControl = new FormControl('');

  getCurrentShape() {
    const current_shape = this.positions[this.current_shape_index];
    if (current_shape) {
      if (current_shape.text_content) {
        this.selectedOption = current_shape.text_content;
      } else {
      }
      return current_shape;
    }
    return null;
  }

  openDialog() {
    const dialogRef = this.dialog.open(CreateTouchDialogComponent, {
      data: {
        x: this.startX,
        y: this.startY,
        width: Math.abs(this.offsetX - this.startX),
        height: Math.abs(this.offsetY - this.startY),
        screenX: this.screenX,
        screenY: this.screenY,
        page_id: this.pageId,
      },
    });
  }
}
