import { Component } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Subscription } from 'rxjs';
import { Genre } from 'src/app/model/genre';
import { Movie } from 'src/app/model/movie';
import { GenreService } from 'src/app/service/genre-service';
import { MovieService } from 'src/app/service/movie-service';

@Component({
  selector: 'app-edit-movie',
  templateUrl: './edit-movie.component.html',
  styleUrls: ['./edit-movie.component.css']
})
export class EditMovieComponent {
  private routeSub: Subscription;
  isFetching: boolean = true;
  id: number;
  msg: any;
  movie: Movie;
  jsonContent: JSON;
  obj: any;
  genres: Genre[] = [];
  rror: boolean = false;

  constructor(private route: ActivatedRoute, private movieService: MovieService, private genreService: GenreService) { }

  addMovieForm = new FormGroup({
    title:new FormControl(),
    genre: new FormControl(),
    length: new FormControl(),
    releaseYear: new FormControl()
  })

  ngOnInit() {
    this.routeSub = this.route.params.subscribe(params => {
      this.id = params['id']
    });    

    this.genreService.getAllGenre().subscribe(
      {
        next: (respone) => {
          this.genres = respone;    
          this.isFetching = false;      
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.isFetching = false;
          this.rror = true;
        }
      }
    );  
    this.movieService.getMovie(this.id).subscribe(
      {
        next: (respone) => {
          this.movie = respone;
          this.isFetching = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.isFetching = false;
        }
      }
    );
  }

  onSubmit() {
    this.obj = {
      "id": this.id,
      "title": this.addMovieForm.get('title')?.value,
      "genreId": this.addMovieForm.get('genre')?.value,
      "length": this.addMovieForm.get('length')?.value,
      "releaseYear": this.addMovieForm.get('releaseYear')?.value
    }
    this.jsonContent = <JSON>this.obj;

    this.movieService.editMovie(this.id, this.jsonContent).subscribe(
      {
        next: (msg) => {
          this.msg = msg.msg;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
        }
      }
    );
  }

  ngOnDestroy() {
    this.routeSub.unsubscribe();
  }
}
