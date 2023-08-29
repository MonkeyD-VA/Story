import { Component } from '@angular/core';
import { LayoutsService } from '../layouts.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent {

  constructor(
    private layoutsService: LayoutsService
  ) { }

  toggleSidebar() {
    this.layoutsService.toggleSidebar();
  }
}
