import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class LayoutsService {

  private sidebarOpen = new BehaviorSubject<boolean>(true);

  constructor() { }

  toggleSidebar() {
    this.sidebarOpen.next(!this.sidebarOpen.value);
  }

  isSidebarOpen() {
    return this.sidebarOpen.asObservable();
  }
}
