import { Component, ViewChild } from '@angular/core';
import { LayoutsService } from '../layouts.service';
import { MatDrawer } from '@angular/material/sidenav';

@Component({
  selector: 'app-main-layouts',
  templateUrl: './main-layouts.component.html',
  styleUrls: ['./main-layouts.component.css']
})
export class MainLayoutsComponent {

  @ViewChild('drawer') drawer:any = MatDrawer;

  constructor(
    private layoutsService: LayoutsService
  ){}

  ngOnInit() {
    // Sync the sidebar state with the service
    this.layoutsService.isSidebarOpen().subscribe(open => {
      if (open) {
        this.drawer.open();
      } else {
        this.drawer.close();
      }
    });
  }
}
