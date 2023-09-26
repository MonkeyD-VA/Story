import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Constants } from '../../config/constants';

@Injectable({
  providedIn: 'root'
})
export class PositionService {

  constructor(private http: HttpClient) { }

  private url = Constants.API_ENDPOINT + 'position';

  getPositionInPage(pageId: any): Observable<any> {
    const url = `${this.url}/page/${pageId}`;
    
    return this.http.get<any>(url);
  }

}
