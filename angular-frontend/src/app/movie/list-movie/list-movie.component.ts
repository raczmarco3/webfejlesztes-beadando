import { Component } from '@angular/core';
import { Movie } from 'src/app/model/movie';
import { MovieService } from 'src/app/service/movie-service';

@Component({
  selector: 'app-list-movie',
  templateUrl: './list-movie.component.html',
  styleUrls: ['./list-movie.component.css']
})
export class ListMovieComponent {
  movies: Movie[] = [];  
  isFetching: boolean;
  msg: any;

  constructor(private movieService: MovieService) { }

  ngOnInit() {
    this.isFetching = true;
    this.movieService.getAllMovie().subscribe(
      {
        next: (respone) => {
          this.movies = respone;
          this.isFetching = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.isFetching = false;
        }
      }
    );
  }
}
