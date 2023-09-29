import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Constants } from '../../config/constants';

@Injectable({
  providedIn: 'root',
})
export class TextService {
  constructor(private http: HttpClient) {}

  private url = Constants.API_ENDPOINT + 'text';

  getAll(): Observable<any> {
    return this.http.get<any>(this.url, Constants.options);
  }

  createText(data: any): Observable<any> {
    const url = `${this.url}/store`;

    return this.http.post<any>(url, data, Constants.options);
  }

  getTextInPage(storyId: number, pageNumber: number): Observable<any> {
    const url = `${this.url}/${storyId}/${pageNumber}`;
    return this.http.get<any>(url, Constants.options);
  }

  updateListText(options: any) {
    const url = `${this.url}/createByList`;
    return this.http.post<any>(url, options, Constants.options);
  }
}
