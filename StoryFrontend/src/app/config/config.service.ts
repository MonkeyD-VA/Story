import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ConfigService {

  constructor(
    private http: HttpClient
  ) { }

  private url = './assets/data/stories.json';

  getStories(): Observable<any> {
    return this.http.get<any>(this.url);
  }

}
