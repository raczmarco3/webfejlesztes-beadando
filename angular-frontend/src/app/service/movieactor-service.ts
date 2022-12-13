import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Message } from '../model/message';
import { MovieActor } from '../model/movie-actor';

@Injectable({
    providedIn: 'root'
})

export class MovieActorService
{
    private baseUrl = 'http://localhost:8000/api/';

    constructor(private http: HttpClient) { }

    getAllMovieActor()
    {
        return this.http.get<MovieActor[]>(`${this.baseUrl}`+'movieactors');
    }

    deleteMovieActor(id: number)
    {
        return this.http.delete<Message>(`${this.baseUrl}`+'movieactor/'+id);
    }

    addMovieActor(jsonContent: JSON)
    {
        return this.http.post<Message>(`${this.baseUrl}`+'movieactor', jsonContent);
    }

    getMovieActor(id: number)
    {
        return this.http.get<MovieActor>(`${this.baseUrl}`+'movieactor/'+id);
    }

    editMovieActor(id: number, jsonContent: JSON)
    {
        return this.http.put<Message>(`${this.baseUrl}`+'movieactor/'+id, jsonContent);
    }
}