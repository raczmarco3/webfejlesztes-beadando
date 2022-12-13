import { Genre } from "./genre";

export class Movie {
    id: number;
    title: string;
    genre: Genre;
    length: number;
    releaseYear: number;
}