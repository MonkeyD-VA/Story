import { Injectable } from '@angular/core'; 
@Injectable() 
export class Constants {
public static API_ENDPOINT: string = 'http://127.0.0.1:8000/api/'; 
// public readonly API_MOCK_ENDPOINT: string = 'https://www.userdomainmock.com/'; 
public static TitleOfSite: string = " Making API calls the Right Way"; 
}