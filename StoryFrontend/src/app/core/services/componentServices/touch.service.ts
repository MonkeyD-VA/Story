import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Constants } from '../../config/constants';

@Injectable({
  providedIn: 'root'
})
export class TouchService {

  constructor(private http: HttpClient) { }

  private url = Constants.API_ENDPOINT + 'touch';

  getTouchInPage(pageNumber: number): Observable<any> {
    // const url = `${this.url}/detail/${pageNumber}`;
    return this.http.get<any>(this.url, Constants.options);
  }

}
