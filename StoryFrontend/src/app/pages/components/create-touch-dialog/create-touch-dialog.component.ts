import { Component, Inject} from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { MatDialogRef } from '@angular/material/dialog';
import {MAT_DIALOG_DATA} from '@angular/material/dialog';
import { PositionService } from 'src/app/core/services/componentServices/position.service';
import { TextService } from 'src/app/core/services/componentServices/text.service';

@Component({
  selector: 'app-create-touch-dialog',
  templateUrl: './create-touch-dialog.component.html',
  styleUrls: ['./create-touch-dialog.component.css']
})
export class CreateTouchDialogComponent {

  selectedFile: File | null = null;

  constructor(
    private positionService: PositionService,
    private formBuilder: FormBuilder,
    private dialogRef: MatDialogRef<CreateTouchDialogComponent>,
    @Inject(MAT_DIALOG_DATA) public data: {x: number, y: number, width: string, height: string, page_id: number}
  ) {}

  textForm = this.formBuilder.group({
    text_content: '',
    text_type: ''
  });


  onFileSelected(event: any): void {
    this.selectedFile = event.target.files[0];
  }

  uploadAudio(): void {
    if (this.selectedFile) {
      // You can handle the selected audio file here, e.g., upload it to a server.
      console.log('Selected audio file:', this.selectedFile);
      // You can add your file upload logic here.
    } else {
      console.error('No audio file selected.');
    }
  }

  onSubmit() {    
    if (this.textForm.value.text_content && this.textForm.value.text_type) {
      this.positionService.createPositionWithText({positions: this.data, texts: this.textForm.value, page_id: this.data.page_id}).subscribe((response) => {
        alert("create position success");
      });
    }
  }

}
