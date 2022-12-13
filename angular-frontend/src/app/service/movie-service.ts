import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Message } from '../model/message';
import { Movie } from '../model/movie';

@Injectable({
    providedIn: 'root'
})

export class MovieService
{
    private baseUrl = 'http://localhost:8000/api/';

    constructor(private http: HttpClient) { }

    getAllMovie()
    {
        return this.http.get<Movie[]>(`${this.baseUrl}`+'movies');
    }

    addMovie(jsonContent: JSON)
    {
        return this.http.post<Message>(`${this.baseUrl}`+'movie', jsonContent);
    }

    deleteMovie(id: number) 
    {
        return this.http.delete<Message>(`${this.baseUrl}`+'movie/'+id);
    }

    getMovie(id: number)
    {
        return this.http.get<Movie>(`${this.baseUrl}`+'movie/'+id);
    }

    editMovie(id: number, jsonContent: JSON)
    {
        return this.http.put<Message>(`${this.baseUrl}`+'movie/'+id, jsonContent);
    }
}