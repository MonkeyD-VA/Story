import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class PageService {

  constructor(
    private http: HttpClient
  ) { }

  private url = './assets/data/pages.json';

  getPages(): Observable<any> {
    return this.http.get<any>(this.url);
  }
}
