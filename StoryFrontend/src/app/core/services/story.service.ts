import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class StoryService {

  constructor(
    private http: HttpClient
  ) { }

  private url = './assets/data/stories.json';
  // private url = 'http://127.0.0.1:8000/api/story';

  getStories(): Observable<any> {
    return this.http.get<any>(this.url);
  }
}
