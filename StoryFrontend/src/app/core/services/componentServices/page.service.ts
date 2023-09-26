import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Constants } from '../../config/constants';

@Injectable({
  providedIn: 'root'
})
export class PageService {

  constructor(
    private http: HttpClient
  ) { }

  private url = Constants.API_ENDPOINT + 'page';

  getPages(): Observable<any> {
    return this.http.get<any>(this.url);
  }

  getAllOfPage(storyId: number, pageNumber: number): Observable<any> {
    const url = `${this.url}/${storyId}/${pageNumber}`;    
    return this.http.get<any>(url);
  }
}
