import { Component } from '@angular/core';

@Component({
  selector: 'app-create-touch-dialog',
  templateUrl: './create-touch-dialog.component.html',
  styleUrls: ['./create-touch-dialog.component.css']
})
export class CreateTouchDialogComponent {
  selectedFile: File | null = null;

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
}
