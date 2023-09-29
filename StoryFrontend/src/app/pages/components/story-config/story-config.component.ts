import { Component } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { MatDialogRef } from '@angular/material/dialog';
import { TextService } from 'src/app/core/services/componentServices/text.service';
import { CreateTouchDialogComponent } from '../create-touch-dialog/create-touch-dialog.component';

@Component({
  selector: 'app-story-config',
  templateUrl: './story-config.component.html',
  styleUrls: ['./story-config.component.css']
})
export class StoryConfigComponent {
  local_data = "newText";
  selectedFile: File | null = null;

  constructor(
    private textService: TextService,
    private formBuilder: FormBuilder,
    private dialogRef: MatDialogRef<CreateTouchDialogComponent>
  ) {}

  textForm = this.formBuilder.group({
    text_content: null,
    text_type: null
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
      this.textService.createText(this.textForm.value).subscribe((response) => {
        console.log(response);  
      });
    }
    this.dialogRef.close(this.textForm.value);
  }
}
