import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Constants } from '../../config/constants';

@Injectable({
  providedIn: 'root'
})
export class TextService {

  constructor(private http: HttpClient) { }

  private url = Constants.API_ENDPOINT + 'text';

  createText(data: any): Observable<any> {
    const url = `${this.url}/store`;
    
    return this.http.post<any>(url, data);
  }

  getTextInPage(storyId: number, pageNumber: number): Observable<any> {
    const url = `${this.url}/${storyId}/${pageNumber}`;    
    return this.http.get<any>(url);
  }


}
